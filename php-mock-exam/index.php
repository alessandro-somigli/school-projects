<html>
    <head>
        <title>homepage</title>

        <?php
            session_start();
        ?>
    </head>
    <body>
        <nav>
            <img src="" alt="logo">

            <label for="searchbar">search: </label>
            <input id="searchbar" type="text">

            <!-- login button/profile -->
            <?php
                $mysqli = new mysqli("", "", "", "");
                
                $user = $_SESSION['user'];

                if ($user) {
                    $user_data = $mysqli -> query("SELECT * FROM USERS WHERE user_id = " + $user) -> fetch_assoc();
                    echo "<span>" + $user_data -> user_name + "</span>";
                } else {
                    echo "<a href='/sign_in.php'>sign in</a>";
                }
            ?>
        </nav>
        <div>
            <!-- community list -->
            <?php
                $mysqli = new mysqli("", "", "", "");

                $communities = $mysqli -> query("SELECT * FROM Community 
                    INNER JOIN Subscribed on Subscribed.community_id = Community.id
                    WHERE Subscribed.user_id = " + $_SESSION['user']);
                
                while ($community = $communities -> fetch_assoc()) {
                    echo "<div>
                            <h3>" + $community -> community_name + "</h3>
                            <span>Subscribers: " + $community -> subscribers_count + "</span>
                            <button>Unsubscribe</button>
                        </div>";
                }

            ?>

            <!-- add community button -->
            <?php
                $user = $_SESSION['user'];
                
                if ($user) {
                    echo "<a href='/add_community_page.php'>add community</a>";
                }
            ?>
        </div>
    </body>
</html>