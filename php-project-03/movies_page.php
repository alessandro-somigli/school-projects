<html>
    <head>
        <title>see all movies</title>
    </head>

    <body>
        <?php
            $mysqli = new mysqli("localhost","root","Magicjesus2000!","school_ex_10");

            if ($mysqli -> connect_errno) exit();
            
            $result = $mysqli->query("SELECT * FROM genres");

            while($genre = $result->fetch_assoc()) {
                echo "<a href='genre_page.php?genre=" . $genre['id'] . "'>" . $genre['name'] . "</a><br>";
            }
        ?>
    </body>
</html>