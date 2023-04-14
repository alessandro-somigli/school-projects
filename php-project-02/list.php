<html>
    <head><title>list</title></head>
    <body class="card">
        <h1>selezione della lista</h1>
        <div class="card-intro">
            <h2>La prima fase del voto prevede la selezione della lista</h2>
        </div>
        <div class="card-body">
            <h3>Scelga la lista a cui assegnare il Suo voto dall'elenco a comparsa qui sotto</h3><br>
            <h4>appena selezionato il candidato, le verrà proposta la conferma definitiva del voto.</h4>
        </div>
        <div class="card-select">
            <form action="/candidate.php" method="get">
                <select name="party_id">
                    <?php
                        $mysqli = new mysqli("localhost", "root", "Magicjesus2000!", "school_ex_09");
                        if ($mysqli -> connect_errno) { echo $mysqli -> connect_error; }

                        $res = $mysqli->query("SELECT * FROM liste;");

                        while ($list = $res->fetch_assoc()) {
                            $id_lista = $list['id_lista'];
                            $nome_lista = $list['nome_lista'];
                            echo "<option value='$id_lista'>$nome_lista</option>";
                        }
                    ?>
                </select>
                <input type="submit">
            </form>
        </div>
    </body>
</html>