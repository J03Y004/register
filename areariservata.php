<?php
    $JWT=$_COOKIE['tokenAreaRiservata'];    //take token from cookie
    $JWTSEPARATO = explode(".", $JWT);      //divide the token in three parts by using the dot as separator
    
    $B64HEADERJSON = $JWTSEPARATO[0];       //header    
    $B64PAYLOADJSON = $JWTSEPARATO[1];      //payload
    $B64FIRMARICEVUTA = $JWTSEPARATO[2];    //signature
    $FIRMARICEVUTA = base64_decode($B64FIRMARICEVUTA);  //base64 --> ascii

    //generation of new signature and comparison with the older one
    $SECRET_KEY = "QfTjWnZr4u7x!z%C*F-JaNdRgUkXp2s5";  //same secret key on first signature
    $UNSIGNEDTOKEN = $B64HEADERJSON . "." . $B64PAYLOADJSON; 
    $SIGNEDTOKEN = hash_hmac('SHA256', $UNSIGNEDTOKEN, $SECRET_KEY);

    if ($FIRMARICEVUTA!=$SIGNEDTOKEN)   // if the new signature is different form the older one data are incorrect, so user is moved to the login page
    {
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
        <title>Reserved Area</title>
    </head>
    <body>
        <?php
        $payload = json_decode(base64_decode($B64PAYLOADJSON));     //let the payload an array
        echo "Hello, " . $payload->nome . " " . $payload->cognome . " welcome to the reserved area";  
        ?>
        <p> <a href="logout.php">Log out</a> </p>
    </body>
</html>