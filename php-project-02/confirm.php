<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        session_start();
    ?>
</head>
<body>
    <div class="card">
        <h1>Conferma del voto</h1>
        <div class="card-header">
            <h2>la terza ed ultima fase del voto consiste nella conferma della selezione</h2>
        </div>
        <div class="card-body">
            <h3>Qui sotto è riepilogata la sua scelta di voto</h3><br>
            <h4>Confermando questa scelta lei esprime in modo definitivo il suo voto</h4>
        </div>
        <div class="card-data">
            <?php
                $candidate_id = $_GET['candidate_id'] ?? -1;
                $_SESSION['candidate_id'] = $candidate_id;
                $party_id = $_SESSION['party_id'] ?? '';

                $mysqli = new mysqli("localhost","root","Magicjesus2000!","school_ex_09");
                if ($mysqli -> connect_errno) echo $mysqli -> connect_error;
                
                $res = $mysqli -> query("SELECT candidati.nome, candidati.cognome, liste.nome_lista FROM candidati 
                    INNER JOIN liste ON candidati.id_lista = liste.id_lista
                    WHERE candidati.id_candidato = '$candidate_id';") 
                    -> fetch_assoc();
                    
                $candidate_fullname = $res['cognome'] . ' ' . $res['nome'];
                $party_name = $res['nome_lista'];

                echo "Lista: $party_name <br>" . 
                    "Candidato: $candidate_fullname";
            ?>
        </div>
        <div class="card-confirm">
            <a href="apis/save.php">Conferma</a>
            <a href="apis/reset.php">Annulla</a>
        </div>
    </div>
</body>
</html>