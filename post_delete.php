<?php

session_start();
if (!empty($_SESSION["user"])) {
    $user = $_SESSION["user"];
    // validate and filter
    $post_id  = $_GET["post_id"];

    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
    
    if ($user["role"] !="admin")    $cond ="and created_by=" .$user["id"];

    $qry = "select id, image from posts  where id=$post_id  $cond";
    $rslt = mysqli_query($cn, $qry);
    if ($row = mysqli_fetch_assoc($rslt)){
        unlink( $row["image"]);
        $qry = "delete from posts where id=$post_id";

        $rslt = mysqli_query($cn, $qry);
    }
    
    // echo mysqli_error($cn);

    mysqli_close($cn);
    header("location:home.php");
    
} else {
    header("location:index.php?secure=page");
}


