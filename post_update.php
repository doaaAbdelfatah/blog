<?php
session_start();
if (!empty($_SESSION["user"]) && ($_SESSION["user"]["role"] == "admin" || $_SESSION["user"]["role"] == "editor" ) ){
    $user = $_SESSION["user"];
    // validate and filter

    $post_id  = $_POST["post_id"];
    $title  = $_POST["title"];
    $body  = $_POST["body"];
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);

    $qry = "select id, image from posts  where id=$post_id ";
    $rslt = mysqli_query($cn, $qry);
    if ($row = mysqli_fetch_assoc($rslt)){
        $file_name  = $row["image"];
    }  

    if(!empty($_FILES["image"]["name"])){
        $file_name = "images/posts/" . date("YmdHis") . "_" . $user["id"] . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["image"]["tmp_name"], $file_name);
        unlink($_POST["image"]);
    }

    if ($user["role"]=="admin") $status ="approved";
    else  $status ="pending";

    $qry = "update posts set title='$title' ,body='$body' ,image='$file_name' ,status ='$status' where id=$post_id and created_by=" . $user["id"];

    $rslt = mysqli_query($cn, $qry);
    // echo mysqli_error($cn);

    mysqli_close($cn);
    header("location:post_edit.php?post_id=$post_id");

} else {
    header("location:index.php?secure=page");
}
