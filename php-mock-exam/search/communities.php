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
                <input type="submit" value="Search">
            </form>
    
            <h3><a href="/home.php">Back to home</a></h3>
        </nav>

        <div>
            <?php
            $communities = $mysqli -> query("SELECT Communities.name AS community_name,
            COUNT(Communities.name) AS total_subscribers,
            CASE WHEN Communities.name IN (
                SELECT Subscriptions.community_name FROM Subscriptions
                WHERE Subscriptions.user_email = '$user_email')
                THEN 1 ELSE 0 END AS is_subscribed
            FROM Communities
            LEFT JOIN Subscriptions ON Communities.name = Subscriptions.community_name
            GROUP BY Communities.name HAVING Communities.name IN (
                SELECT Communities.name FROM Communities
                    WHERE Communities.name LIKE '%$query%'
                    ); ");

            while ($community = $communities -> fetch_assoc()) {
                $community_name = $community['community_name'];
                $total_subscribers = $community['total_subscribers'];
                echo "<div>
                    <h1><a href='/community.php?c=$community_name'>$community_name</a></h1>
                    <p>subscribers: $total_subscribers</p>";
                if($community['is_subscribed']) {
                    echo "<a href='/fn/unsubscribe.php?c=$community_name&r=/home.php'>unsubscribe</a>";
                }
                echo "</div>";
            }
            ?>
        </div>
    </body>
    
    <link rel="stylesheet" href="/style/globals.css">
</html>