<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login Completed</title>
</head>

<body>
    <?php
    //PARAMETRI RICEVUTI DAL CLIENT
    $contatto_email = $_POST['contatto_email'];
    $contatto_password = $_POST['password'];

    // nome di host
    $host = "localhost";
    // nome del database
    $db = "register";
    // username dell'utente in connessione
    $user = "root";
    // password dell'utente
    $password = "";

    /*
    blocco try/catch di gestione delle eccezioni
  */
    try {

        // stringa di connessione al DBMS
        $connessione = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        // imposto l'attributo per il report degli errori
        $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // preparazione della query SQL
        $sql = $connessione->prepare("SELECT * FROM users WHERE contatto_email = :contatto_email AND password = :contatto_password");

        // bind dei parametri
        $sql->bindParam(':contatto_email', $contatto_email, PDO::PARAM_STR, 7);
        $sql->bindParam(':contatto_password', $contatto_password, PDO::PARAM_STR, 7);

        // esecuzione del prepared statement
        $sql->execute();

        // conteggio dei record coinvolti dalla query
        if ($sql->rowCount() == 1) {
            // creazione di un'array contenente il risultato
            $result = $sql->fetchAll();

            // ciclo dei risultati
            foreach ($result as $row) {
                $nome = $row['nome'];
                $cognome = $row['cognome'];
                $emailutente = $row['contatto_email'];
            }

            //INIZIO COSTRUIZIONE TOKEN 

            $SECRET_KEY = "QfTjWnZr4u7x!z%C*F-JaNdRgUkXp2s5";
            $scadenza = strtotime("+1 day");

            $HEADER =  [
                'alg' => 'SHA256',
                'type' => 'JWT',
                'ttl' => $scadenza
            ];

            $PAYLOAD = [
                'nome' => $nome,
                'cognome' => $cognome,
                'contatto_email' => $contatto_email
            ];

            $HEADERJSON = json_encode($HEADER);
            $PAYLOADJSON = json_encode($PAYLOAD);
            $B64HEADERJSON = base64_encode($HEADERJSON);
            $B64PAYLOADJSON = base64_encode($PAYLOADJSON);
            $UNSIGNEDTOKEN = $B64HEADERJSON . "." . $B64PAYLOADJSON;
            $SIGNEDTOKEN = hash_hmac('SHA256', $UNSIGNEDTOKEN, $SECRET_KEY);
            $B64SIGNEDTOKEN = base64_encode($SIGNEDTOKEN);
            $TOKEN = $B64HEADERJSON . "." . $B64PAYLOADJSON . "." . $B64SIGNEDTOKEN;
            $TIPORISPOSTA = 1;
            $RISPOSTA = $TOKEN;

            //FINE COSTRUZIONE token_get_all
        } else {
            $TIPORISPOSTA = 0;
            $RISPOSTA = "L'UTENTE NON ESISTE O PASSWORD ERRATA.";
        }
        // chiusura della connessione
        $connessione = null;
    } catch (PDOException $e) {
        // notifica in caso di errore nel tentativo di connessione
        $TIPORISPOSTA = 0;
        $RISPOSTA = $e->getMessage();
    }

    $RISP =  [
        'tiporisposta' => $TIPORISPOSTA,
        'risposta' => $RISPOSTA
    ];
    
    echo (json_encode($RISP));
    ?>
</body>

</html>