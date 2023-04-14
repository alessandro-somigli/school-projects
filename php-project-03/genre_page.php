<html>
    <head>
        <title>genre</title>
    </head>

    <body>
        <?php
            $genre = $_GET['genre'] ?? null;

            $mysqli = new mysqli("localhost","root","Magicjesus2000!","school_ex_10");

            if ($mysqli -> connect_errno) exit();
            
            $result = $mysqli->query("SELECT * FROM movies WHERE movies.id = " . $genre . ";");

            while ($movie = $result->fetch_assoc()) {
                echo "<p>" . $movie['title'] . "</p>";
            }
        ?>
    </body>
</html>