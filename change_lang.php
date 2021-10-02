<?php

    var_dump($_SERVER);
    session_start();
    if (!empty($_REQUEST["lang"])){
        if ($_REQUEST["lang"] =="ar") $_SESSION["lang"]="ar";
        elseif ($_REQUEST["lang"] =="fr") $_SESSION["lang"]="fr";
        else $_SESSION["lang"]="en";
    }else $_SESSION["lang"]="en";
     header("location:" .$_SERVER["HTTP_REFERER"]);