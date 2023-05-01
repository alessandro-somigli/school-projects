<html>
    <head><title>home</title></head>
    <body>
        <?php
        session_start();
        include $_SERVER['DOCUMENT_ROOT']."/utils/connection.php";

        $user_email = $_SESSION['user_email'] ?? null;
        ?>
        <nav>
            <?php
            if ($user_email) {
                $user = $mysqli -> query("SELECT * FROM Users WHERE Users.email = '$user_email';") -> fetch_assoc();
                $username = $user['username'];
                echo "<h1>$username</h1>";
                echo "<a href='/fn/user/logout.php'>log out</a>";
            } else {
                echo "<h1>home</h1>";
                echo "<a href='/auth/login.php'>log in</a>";
            }
            ?>

            <!-- <form action="/search/communities.php" method="GET">
                <input type="text" name="q">
                <input type="submit" value="search">
            </form> -->
        </nav>
        <div>
            <?php
            if ($user_email) {
                $communities = $mysqli -> query("SELECT Subscriptions.community_name, 
                COUNT(*) AS total_subscribers FROM Subscriptions 
                GROUP BY Subscriptions.community_name HAVING Subscriptions.community_name IN (
                  SELECT Subscriptions.community_name FROM Subscriptions 
                    WHERE Subscriptions.user_email = '$user_email'
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

                echo "<a href='/add/community.php'>create a community</a>";
            } else {
                echo "<h1>login to view some communities!</h1>";
            }
            ?>
        </div>

        <link rel="stylesheet" href="/style/globals.css">
    </body>
</html>