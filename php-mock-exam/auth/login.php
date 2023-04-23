<html>
    <head><title>login</title></head>
    <body>
        <?php
        session_start();

        $user_email = $_SESSION['user_email'] ?? null;
        if ($user_email) { header("Location: /home.php"); }
        ?>

        <nav>
            <h1>Login</h1>
        </nav>

        <div>
            <form action="/fn/user/login.php" method="POST">
                <label for="email">email: </label>
                <input type="email" name="email"> <br><br>

                <label for="password">password: </label>
                <input type="password" name="password"> <br><br>

                <input type="submit" value="submit">
            </form>
            <h4><a href="/auth/signup.php">don't have an account?</a></h4>
            <h4><a href="/home.php">home</a></h4>
        </div>
    </body>
</html>