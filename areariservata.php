<?php
    //PARAMETRO RICEVUTI DAL CLIENT
    $JWT=$_COOKIE['tokenAreaRiservata'];

    //divido il token in 3 parti sfruttando il . come separatore
    $JWTSEPARATO = explode(".", $JWT);

    //IL PRIMO ELEMENTO DEL JWTSEPARATO è header
    $B64HEADERJSON = $JWTSEPARATO[0];

    //IL PRIMO ELEMENTO DEL JWTSEPARATO è PAYLOAD
    $B64PAYLOADJSON = $JWTSEPARATO[1];

    //IL TERZO ELEMENTO DEL JWTSEPARATO è LA FIRMA
    $B64FIRMARICEVUTA = $JWTSEPARATO[2];

    //TRASFORMO LA FIRMA DA CODIFICA B64 IN CODIFICA ASCII
    $FIRMARICEVUTA = base64_decode($B64FIRMARICEVUTA);

    //DEVO GENERARE LA NUOVA IMPRONTA/FIRMA/DIGEST E CONFRONTARLA CON QUELLA RICEVUTA
    $SECRET_KEY = "QfTjWnZr4u7x!z%C*F-JaNdRgUkXp2s5";  //USO LA STESSA PASSWORD UTILIZZATA IN FASE DI CREAZIONE DEL TOKEN

    $UNSIGNEDTOKEN = $B64HEADERJSON . "." . $B64PAYLOADJSON;
        
    $SIGNEDTOKEN = hash_hmac('SHA256', $UNSIGNEDTOKEN, $SECRET_KEY);

    if ($FIRMARICEVUTA!=$SIGNEDTOKEN)  {
        header("Location: login.html");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area riservata</title>
</head>
<body>
    Benvenuto nell'area riservata:
    <a href="logout.php">Log out</a>
    <?php
    $payload = json_decode(base64_decode($B64PAYLOADJSON));
    echo $payload->nome . " " . $payload->cognome;
    ?>
</body>
</html>