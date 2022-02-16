<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign up Completed</title>
</head>

<body>
    <?php
        $host = "localhost";
        $db = "nominativi";
        $user = "root";
        $password = "";

        try {
            $connessione = new PDO("mysql:host=$host;dbname=$db", $user, $password);        // stringa di connessione al DBMS
            $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);          // imposto l'attributo per il report degli errori
            $contatto_cognome = $_POST['cognome'];                                          // definizione delle variabili per la query
            $sql = $connessione->prepare("SELECT * FROM contatti WHERE cognome = :contatto_cognome");   // preparazione della query SQL
            $sql->bindParam(':contatto_cognome', $contatto_cognome, PDO::PARAM_STR, 7);     // bind dei parametri
            $sql->execute();                                                                // esecuzione del prepared statement

            if ($sql->rowCount() > 0)                                                       // conteggio dei record coinvolti dalla query
            {                                                     
                $result = $sql->fetchAll();                                                 // creazione di un'array contenente il risultato
                foreach ($result as $row)                                                   // ciclo dei risultati
                {                                                 
                    echo $row['id'] . "<br />";
                }
            }
            else
                echo "Nessun record corrispondente alla richiesta.";

            $connessione = null;                                                            // chiusura della connessione
        } catch (PDOException $e) {
            echo $e->getMessage();                                                          // notifica in caso di errore nel tentativo di connessione
        }
    ?>
</body>

</html>