<html>
    <head>
        <title>community</title>
    </head>
    <body>
        <nav>
            <?php
                $mysqli = new mysqli("", "", "", "");

                $community_id = $_GET['c'];
                $community_data = $mysqli -> query("SELECT * FROM Community WHERE Community.id = " + $community_id) ->fetch_assoc();

                if ($community_data) {
                    echo "<span>" + $community_data -> community_name + "</span>";
                }
            ?>
        </nav>
        <div>
            <?php
                $mysqli = new mysqli("", "", "", "");

                $community_id = $_GET['c'];
                $community_data = $mysqli -> query("SELECT * FROM Community WHERE Community.id = " + $community_id) ->fetch_assoc();

                if ($community_data) {
                    $events = $mysqli -> query("SELECT * FROM Events WHERE Events.community_id = " + $community_id);
                    while ($event = $events -> fetch_assoc()) {
                        echo "
                            <div>
                                <h1>" + $event -> event_name + "</h1>
                                <span>location: " + $event -> event_location + "</span>
                                <span>date: " + $event -> event_date + "</span>
                            </div>
                        ";
                    }
                } else { echo "community not found."; }
            ?>

            <?php
                $user = $_SESSION['user'];
                if ($user) {
                    echo "<a href='/add_event.php'>add event</a>";
                }
            ?>
            
        </div>
    </body>
</html>