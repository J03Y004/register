<?php
    // sets the expiration date in the past so the token results to be expired
    setcookie("tokenAreaRiservata", "", time() - 1, '/');
    unset($_COOKIE["tokenAreaRiservata"]);
    header("Location: login.html");
?>