<html>
    <head><title>write a new review</title></head>
    <body>
        <?php
        session_start();

        $user_email = $_SESSION['user_email'];

        $event = $_GET['e'] ?? '';
        if (!$user_email) {
            echo "<h2>Login to create a new review: <a href='/auth/login.php?r=/add/review.php?e=$event'>login</a></h2>";
            exit();
        }
        ?>

        <nav>
            <h1>Write a new Review</h1>

            <?php
            echo "<h3><a href='/event.php?e=$event'>back to the event</a></h3>";
            ?>

            <h3><a href="/home.php">go back home</a><h3>
        </nav>

        <div>
            <form action='/fn/create/review.php' method='GET'>
            
                <label for="">title: </label>
                <input name="title" type="text"> <br><br>

                <label for="">text: </label><br>
                <textarea name="text"></textarea> <br><br>

                <input type="radio" name="rating" value="1" checked>
                <label for="">1</label>
                <input type="radio" name="rating" value="2" checked>
                <label for="">2</label>
                <input type="radio" name="rating" value="3" checked>
                <label for="">3</label>
                <input type="radio" name="rating" value="4" checked>
                <label for="">4</label>
                <input type="radio" name="rating" value="5" checked>
                <label for="">5</label> <br><br>

                <?php
                echo "<input type='hidden' name='e' value='$event'>";
                ?>

                <input type="submit">
            </form>
        </div>

        <link rel="stylesheet" href="/style/globals.css">
    </body>
</html>