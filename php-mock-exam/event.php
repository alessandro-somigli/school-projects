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
                WHERE Events.id = '$event_id';") -> fetch_assoc();

            if ($event) {
                $event_name = $event['event_name'];
                echo "<h1>$event_name</h1>";
                
                
            } else { echo "<h1>???</h1>"; }

            $community_name = $event['community_name'];
            echo "<h3><a href='/community.php?c=$community_name'>back to $community_name</a></h3>"
            ?>

            <h3><a href="/home.php">back to home</a></h3>
        </nav>

        <div>
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
                    <p>rating: $rating *</p>
                    <p>owner: $owner_email</p>
                </div>";
            }

            if ($user_email) { echo "<a href='/add/review.php'>write a review</a>"; }
            ?>
        </div>
    </body>
</html>