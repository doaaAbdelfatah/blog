<?php

session_start();
if (!empty($_SESSION["user"]) && $_SESSION["user"]["role"] =="admin") {
    $user = $_SESSION["user"];

    $post_id  = $_GET["post_id"];
    $action  = $_GET["action"];

    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);

    $qry = "update posts set status='$action' ,action_by =".$user["id"]." where id=$post_id";
    $rslt = mysqli_query($cn, $qry);
        
    echo mysqli_error($cn);

    mysqli_close($cn);
    header("location:home.php");
    
} else {
    header("location:index.php?secure=page");
}


