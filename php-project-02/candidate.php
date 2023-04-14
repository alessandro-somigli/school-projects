<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>candidate</title>
    <?php
        session_start();
    ?>
</head>
<body>
    <h1>selezione del candidato</h1>
    <div class="card">
        <div class="card-header">
            <h2>la seconda fase del voto prevede la scelta del candidato</h2>
        </div>
        <div class="card-body">
            <h3>scelga il candidato da assegnare il Suo voto dall'elenco a comparsa qui sotto</h3><br>
            <h4>appena selezionato il candidato, le verrà proposta la conferma definitiva del voto</h4>
        </div>
        <div class="card-select">
            <form action="/confirm.php" method="get">
                <select name="candidate_id">
                    <?php
                        $party_id = $_GET['party_id'] ?? '';
                        $_SESSION['party_id'] = $party_id;

                        $mysqli = new mysqli("localhost","root","Magicjesus2000!","school_ex_09");
                        if ($mysqli -> connect_errno) echo $mysqli -> connect_error;

                        $res = $mysqli -> query("SELECT candidati.nome, candidati.cognome, candidati.id_candidato FROM liste 
                                INNER JOIN candidati ON candidati.id_lista = liste.id_lista
                                WHERE liste.id_lista = '$party_id';");

                        while ($candidate = $res->fetch_assoc()) {
                            $id_candidato = $candidate['id_candidato'];
                            $candidate_fullname = $candidate['cognome'] . ' ' . $candidate['nome'];
                            echo "<option value='$id_candidato'>$candidate_fullname</option>";
                        }
                    ?>
                </select>
                <input type="submit">
            </form>
        </div>
    </div>
</body>
</html>