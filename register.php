<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Registration Completed</title>
</head>
<body>
    <?php
        // definizione delle variabili per la query
        $contatto_nome = $_POST['name'];
        $contatto_cognome = $_POST['surname'];                                         
        $contatto_email = $_POST['email'];
        $contatto_password = $_POST['password'];

        $HEADER = [
            'alg' => 'SHA256',
            'type' => 'JWT'
        ];

        $PAYLOAD = [
            'password' => $contatto_password
        ];

        $host = "localhost";        // nome di host
        $db = "users";              // nome del database
        $user = "root";             // username dell'utente in connessione
        $password = "";             // password dell'utente
        
        /*
            blocco try/catch di gestione delle eccezioni
        */
        try {
            // stringa di connessione al DBMS
            $connessione = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            // imposto l'attributo per il report degli errori
            $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // definizione delle variabili per la query
            $contatto_cognome = $_POST['surname'];
            $contatto_nome = $_POST['name'];
            $contatto_email = $_POST['email'];
            $contatto_password = $_POST['password'];

            $SECRET_KEY = "QfTjWnZr4u7x!z%C*F-JaNdRgUkXp2s5";

            $HEADER =  [
                'alg' => 'SHA256',
                'type' => 'JWT',
            ];

            $PAYLOAD = [
                'password' => $contatto_password 
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

            // preparazione della query SQL
            $sql = $connessione->prepare("INSERT INTO FROM users (nome, cognome, email, password) VALUES (:contatto_nome, :contatto_cognome, :contatto_email, :contatto_password");
             // bind dei parametri
            $sql->bindParam(':contatto_cognome', $contatto_cognome, PDO::PARAM_STR, 7);
            $sql->bindParam(':contatto_nome', $contatto_nome, PDO::PARAM_STR, 7);
            $sql->bindParam(':contatto_email', $contatto_email, PDO::PARAM_STR, 7);
            $sql->bindParam(':contatto_password', $contatto_password, PDO::PARAM_STR, 7);
            $sql->execute();                                                                // esecuzione del prepared statement
            $connessione = null;                                                            // chiusura della connessione
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();                                                          // notifica in caso di errore nel tentativo di connessione
        }
    ?>
</body>
</html>