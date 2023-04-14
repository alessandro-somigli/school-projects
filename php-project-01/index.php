<html>
    <head>
        <?php
            session_start();
        ?>
        <title>home</title>
    </head>
    <body>
        <?php
            $user = $_SESSION['user'];
            if ($user) header('Location: user_page.php');
        ?>
        <h1>welcome:</h1><br>
        <a href='/signup_form.html'>signup</a><br>
        <a href='/login_form.html'>login</a>
    </body>
</html>