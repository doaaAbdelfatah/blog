<?php
// echo "<pre>";
// var_dump($_POST);
// var_dump($_FILES);
// echo "</pre>";

session_start();
if (!empty($_SESSION["user"]) && ($_SESSION["user"]["role"] == "admin" || $_SESSION["user"]["role"] == "editor" ) ){
    $user = $_SESSION["user"];
    // validate and filter

    $title  = $_POST["title"];
    $body  = $_POST["body"];

    $file_name = "images/posts/" . date("YmdHis") . "_" . $user["id"] . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    move_uploaded_file($_FILES["image"]["tmp_name"], $file_name);

    if ($user["role"]=="admin") $status ="approved";
    else  $status ="pending";
    $qry = "insert into posts (title ,body ,image ,created_by ,status) values ('$title' ,'$body' ,'$file_name' ," . $user['id'] .  " ,'$status')";

    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
    $rslt = mysqli_query($cn, $qry);
    // echo mysqli_error($cn);

    mysqli_close($cn);
    header("location:home.php");

} else {
    header("location:index.php?secure=page");
}
