<html>
    <head><title>create an event</title></head>
    <body>
        <?php
        session_start();

        $user_email = $_SESSION['user_email'];

        $community = $_GET['c'] ?? '';
        if (!$user_email) {
            echo "<h2>Login to create a new event: <a href='/auth/login.php?r=/add/event.php?c=$community'>login</a></h2>";
            exit();
        }
        ?>

        <nav>
            <h1>Create a new Event</h1>
            
            <?php
            echo "<h3><a href='/community.php?c=$community'>back to $community</a></h3>";
            ?>

            <h3><a href="/home.php">go back home</a><h3>
        </nav>

        <div>
            <form action='/fn/create/event.php' method='GET'>
                <label for="">name: </label>
                <input name="name" type="text"> <br><br>

                <label for="">description: </label><br>
                <textarea name="description"></textarea> <br><br>

                <label for="">location: </label>
                <input name="location" type="text"> <br><br>

                <label for="">date: </label>
                <input name="date" type="date"> <br><br>

                <?php
                echo "<input type='hidden' name='c' value='$community'>";
                ?>

                <input type="submit">
            </form>
        </div>

        <link rel="stylesheet" href="/style/globals.css">
    </body>
</html>