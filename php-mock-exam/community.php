<html>
    <head><title>community</title></head>
    <body>
        <?php
        session_start();
        include $_SERVER['DOCUMENT_ROOT']."/utils/connection.php";
        $user_email = $_SESSION['user_email'] ?? null;
        $community_name = $_GET['c'];
        ?>

        <nav>
            <?php
            $community = $mysqli -> query("SELECT Communities.name, 
                COUNT(*) AS total_subscribers,
                CASE WHEN Communities.name IN (
                    SELECT Subscriptions.community_name FROM Subscriptions
                    WHERE Subscriptions.user_email = '$user_email')
                    THEN 1 ELSE 0 END AS is_subscribed
                FROM Communities
                    INNER JOIN Subscriptions ON Communities.name = Subscriptions.community_name
                    WHERE Communities.name = '$community_name'
                    GROUP BY Subscriptions.community_name;") -> fetch_assoc();

            if ($community) {
                $total_subscribers = $community['total_subscribers'];
                echo "<h1>$community_name</h1>";
                echo "<h2>subscribers: $total_subscribers</h2>";
                
                if ($user_email) {
                    if ($community['is_subscribed'] == 1) { echo "<a href='/fn/unsubscribe.php?c=$community_name'>unsubscribe</a>"; }
                    else { echo "<a href='/fn/subscribe.php?c=$community_name'>subscribe</a>"; }
                }
            } else { echo "<h1>???</h1>"; }
            ?>

            <h3><a href="/home.php">back to home</a></h3>
        </nav>

        <div>
            <?php
            if ($community) {
                $events = $mysqli -> query("SELECT * FROM Events 
                WHERE Events.community_name = '$community_name' 
                ORDER BY Events.starting_date;");

                while ($event = $events -> fetch_assoc()) {
                    $event_id = $event['id'];
                    $event_name = $event['event_name'];
                    $event_description = $event['event_description'];
                    $event_location = $event['event_location'];
                    $event_date = $event['starting_date'];
                    echo "<div>
                            <h1><a href='/event.php?e=$event_id'>$event_name</a></h1>
                            <p>description: $event_description</p>
                            <p>location: $event_location</p>
                            <p>date: $event_date</p>
                        </div>";
                }

                if ($user_email) { echo "<a href='/add/event.php'>add an event</a>"; }
            } else {
                echo "<h3>This community does not exist :(</h3>";
            }
            ?>
        </div>
    </body>
</html>