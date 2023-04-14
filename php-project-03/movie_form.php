<html>
    <head>
        <title>insert a movie</title>
    </head>
    <body>
        <h1>Insert a new movie</h1>
        <form action="api/insert_movie.php" method="GET">
            <label for="title">Title: </label>
            <input name="title" type="text"><br>
            
            <label for="director">Director: </label>
            <input name="director" type="text"><br>
            
            <label for="year">Year: </label>
            <input name="year" type="number"><br>

            <label for="type">Type: </label>
            <select name="type" id="type">
                <?php
                    $mysqli = new mysqli("localhost","root","Magicjesus2000!","school_ex_10");

                    if ($mysqli -> connect_errno) exit();
                    
                    $result = $mysqli->query("SELECT * FROM types");

                    while($type = $result->fetch_assoc()) {
                        echo "<option value='" . $type['id'] . "'>" . $type['name'] . "</option>";
                    }
                ?>
            </select><br>

            <label for="genre">Genre: </label>
            <select name="genre" id="genre">
                <?php
                    $mysqli = new mysqli("localhost","root","Magicjesus2000!","school_ex_10");

                    if ($mysqli -> connect_errno) exit();
                    
                    $result = $mysqli->query("SELECT * FROM genres");

                    while($genre = $result->fetch_assoc()) {
                        echo "<option value='" . $genre['id'] . "'>" . $genre['name'] . "</option>";
                    }
                ?>
            </select><br>

            <input type="submit" value="send">
        </form>

        <a href="index.html">back to home</a>
    </body>
</html>