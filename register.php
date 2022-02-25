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

    $host = "localhost";        // nome di host
    $db = "register";              // nome del database
    $user = "root";             // username dell'utente in connessione
    $password = "";             // password dell'utente

    try {
        // stringa di connessione al DBMS
        $connessione = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        // imposto l'attributo per il report degli errori
        $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // definizione delle variabili per la query
        $contatto_cognome = $_POST['surname'];
        $contatto_nome = $_POST['name'];
        $contatto_email = $_POST['email'];
        $contatto_password = hash('SHA256',$_POST['password']);

        $sql = $connessione->prepare("SELECT * FROM users WHERE contatto_email = :contatto_email AND password = :contatto_password");

        // preparazione della query SQL
        $sql = $connessione->prepare("INSERT INTO `users`(`name`, `surname`, `email`, `password`) VALUES (:contatto_nome, :contatto_cognome, :contatto_email, :contatto_password)");
        // bind dei parametri
        $sql->bindParam(':contatto_cognome', $contatto_cognome, PDO::PARAM_STR, 7);
        $sql->bindParam(':contatto_nome', $contatto_nome, PDO::PARAM_STR, 7);
        $sql->bindParam(':contatto_email', $contatto_email, PDO::PARAM_STR, 7);
        $sql->bindParam(':contatto_password', $contatto_password, PDO::PARAM_STR, 7);
        $sql->execute();                                                                // esecuzione del prepared statement
        $connessione = null;                                                            // chiusura della connessione

        echo '<section class="signup">
                <div class="container">
                    <div class="signup-content">
                        <h2 class="form-title">Registration Complete</h2>
                        <form method="POST" action="signin.html" id="signup-form" class="signup-form">
                            <div class="form-group">
                                <input type="submit" name="submit" id="submit" class="form-submit" value="Login"/>
                            </div>
                        </form>
                    </div>
                </div>
              </section>';
    } catch (PDOException $e) {
        echo $e->getMessage();                                                          // notifica in caso di errore nel tentativo di connessione
    }
    ?>
</body>

</html>