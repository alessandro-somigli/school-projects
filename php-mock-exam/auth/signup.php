<html>
    <head><title>signup</title></head>
    <body>
        <?php
        session_start();

        $user_email = $_SESSION['user_email'] ?? null;
        if ($user_email) { header("Location: /home.php"); }
        ?>

        <nav>
            <h1>Signup</h1>
        </nav>

        <div>
            <form action="/fn/user/signup.php" method="POST">
                <label for="email">email: </label>
                <input type="email" name="email"> <br><br>

                <label for="first_name">first name: </label>
                <input type="text" name="first_name"> <br><br>

                <label for="last_name">last name: </label>
                <input type="text" name="last_name"> <br><br>

                <label for="username">username: </label>
                <input type="text" name="username"> <br><br>

                <label for="password">password: </label>
                <input type="password" name="password"> <br><br>

                <input type="submit" value="submit">
            </form>
            <h4><a href="/auth/login.php">already have an account?</a></h4>
            <h4><a href="/home.php">home</a></h4>
        </div>

        <link rel="stylesheet" href="/style/globals.css">
    </body>
</html>