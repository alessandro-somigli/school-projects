<html>
    <head><title>search results</title></head>
    <body>
        <?php
        session_start();
        include $_SERVER['DOCUMENT_ROOT']."/utils/connection.php";
        $user_email = $_SESSION['user_email'] ?? null;
        $query = $_GET['q'];
        ?>

        <nav>
            <h1>Search Results: </h1>

            <form action="/search/communities.php" method="GET" class="search_form">
                <input type="text" name="q" value="<?php echo $query; ?>">
                <input type="submit" value="search">
            </form>

            <h3><a href="/home.php">back to home</a></h3>
        </nav>

        <div>
            <?php
            $communities = $mysqli -> query("SELECT Subscriptions.community_name, 
            COUNT(*) AS total_subscribers FROM Subscriptions 
            GROUP BY Subscriptions.community_name HAVING Subscriptions.community_name IN (
              SELECT Subscriptions.community_name FROM Subscriptions 
                WHERE Subscriptions.community_name LIKE '%$query%'
            );");

            while ($community = $communities -> fetch_assoc()) {
                $community_name = $community['community_name'];
                $total_subscribers = $community['total_subscribers'];
                echo "<div>
                    <h1><a href='/community.php?c=$community_name'>$community_name</a></h1>
                    <p>subscribers: $total_subscribers</p>
                    <a href='/fn/unsubscribe.php?c=$community_name&r=/home.php'>unsubscribe</a>
                </div>";
            }
            ?>
        </div>
    </body>
    
    <link rel="stylesheet" href="/style/globals.css">
</html>