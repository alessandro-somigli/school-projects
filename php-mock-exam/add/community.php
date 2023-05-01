<html>
    <head><title>create a community</title></head>
    <body>
        <?php
        session_start();

        $user_email = $_SESSION['user_email'];

        if (!$user_email) {
            echo "<h2>Login to create a new community: <a href='/auth/login.php?r=/add/community.php'>login</a></h2>";
            exit();
        }
        ?>

        <nav>
            <h1>Create a new Community</h1>
            <h3><a href="/home.php">go back home</a><h3>
        </nav>

        <div>
            <form action="/fn/create/community.php" method="GET">
                <label for="">name: </label>
                <input name="c" type="text"> <br><br>

                <input type="submit">
            </form>
        </div>
        
        <link rel="stylesheet" href="/style/globals.css">
    </body>
</html>