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
        // nome di host
        $host = "localhost";
        // nome del database
        $db = "users";
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
            // definizione delle variabili per la query
            $contatto_cognome = $_POST['surname'];
            $contatto_nome = $_POST['name'];
            $contatto_email = $_POST['email'];
            $contatto_password = $_POST['password'];
            // preparazione della query SQL
            $sql = $connessione->prepare("INSERT INTO FROM users (nome, cognome, email, password) VALUES (:contatto_nome, :contatto_cognome, :contatto_email, :contatto_password");
            // bind dei parametri
            $sql->bindParam(':contatto_cognome', $contatto_cognome, PDO::PARAM_STR, 7);
            $sql->bindParam(':contatto_nome', $contatto_nome, PDO::PARAM_STR, 7);
            $sql->bindParam(':contatto_email', $contatto_email, PDO::PARAM_STR, 7);
            $sql->bindParam(':contatto_password', $contatto_password, PDO::PARAM_STR, 7);
            // esecuzione del prepared statement
            $sql->execute();
            // chiusura della connessione
            $connessione = null;
        }
        catch(PDOException $e)
        {
            // notifica in caso di errore nel tentativo di connessione
            echo $e->getMessage();
        }
    ?>
</body>
</html>