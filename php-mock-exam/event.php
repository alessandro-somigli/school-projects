<html>
    <head><title>event</title></head>
    <body>
        <?php
        session_start();
        $user_email = $_SESSION['user_email'];

        include $_SERVER['DOCUMENT_ROOT']."/utils/connection.php";
        ?>

        <nav>
            <?php
            $event_id = $_GET['e'] ?? -1;
            $event = $mysqli -> query("SELECT * FROM Events
                WHERE Events.id = $event_id;") -> fetch_assoc();

            if ($event) {
                $community_name = $event['community_name'];
                $event_name = $event['event_name'];
                echo "<h1>$community_name | $event_name</h1>";
                
                echo "<h3><a href='/community.php?c=$community_name'>back to $community_name</a></h3>";
            } else { echo "<h1>???</h1>"; }
            ?>

            <h3><a href="/home.php">Back to home</a></h3>
        </nav>

        <div>
            <h1>Event Data:</h1>
            <div>
            <?php
            if ($event) {
                $event_description = $event['event_description'];
                $event_location = $event['event_location'];
                $starting_date = $event['starting_date'];

                echo "<h1>$event_name</h1>";
                echo "<h3>$event_description</h3>";
                echo "<p>location: $event_location<p>";
                echo "<p>date: $starting_date</p>";
            } else { echo "<h1>???</h1>"; }
            ?>
            </div>

            <h1>Reviews:</h1>
            <?php
            $reviews = $mysqli -> query("SELECT * FROM Reviews
                INNER JOIN Events ON Reviews.event_id = Events.id
                WHERE Events.id = $event_id;");

            while ($review = $reviews -> fetch_assoc()) {
                $title = $review['title'];
                $text = $review['text'];
                $rating = $review['rating'];
                $owner_email = $review['user_email'];

                echo "<div>
                    <h1>$title</h1>
                    <p>$text</p>
                    <p>Rating: $rating *</p>
                    <p>Owner: $owner_email</p>
                </div>";
            }

            $subscribed = $mysqli -> query("SELECT Subscriptions.user_email FROM Subscriptions WHERE 
                Subscriptions.community_name = '$community_name' AND Subscriptions.user_email = '$user_email';") -> num_rows > 0;
                
            if ($subscribed) { echo "<h3><a href='/add/review.php?e=$event_id'>Write a review</a></h3>"; }
            ?>
        </div>

        <link rel="stylesheet" href="/style/globals.css">
    </body>
</html>