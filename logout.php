<?php

// imposta una scadenza nel passato cosi che scada immediatamente
setcookie("tokenAreaRiservata", "", time() - 1, '/');
unset($_COOKIE["tokenAreaRiservata"]);
header("Location: login.html");

?>