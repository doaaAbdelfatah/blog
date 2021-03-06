<?php
session_start();

$lang ="en";
if (!empty($_SESSION["lang"])){
  $lang=$_SESSION["lang"];
}

if ($lang =="ar") require_once("messages_ar.php");
else require_once("messages_en.php");


if (empty($_SESSION["user"])){
	header("location:index.php?secure=page");
}else{
	$user= $_SESSION["user"];
if ($active_link =="users" && $user["role"] != "admin"){
    header("location:index.php?secure=page");
}
}

?>
<!DOCTYPE html>
<html lang="<?=$lang?>" dir="<?=$messages ["dir"]?>">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body  style="background: linear-gradient(-135deg, #c850c0, #4158d0);">
	
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">BLOG</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- <pre>
  <?php 
//   var_dump($_SERVER)
  ?>
  </pre> -->

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item <?php 
    //    if ( strpos($_SERVER["REQUEST_URI"] ,"home.php" ) ){
    //     echo "active";
    //    }
    if($active_link  =="home")echo "active";
      ?>">
        <a class="nav-link " href="home.php">Home </a>
      </li>

      <?php if ($user["role"] == "admin") { ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php 
    //    if ( strpos($_SERVER["REQUEST_URI"],"users.php"  ) ){
    //     echo "active";
    //    }
        if($active_link  =="users")echo "active";
      ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Users
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="users_create.php">Add User</a>
          <a class="dropdown-item" href="users.php">Users List</a>
          <!-- <div class="dropdown-divider"></div> -->

        </div>
      </li>
        <?php }?>
     
    </ul>

    <ul class="navbar-nav mr-auto">


<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <?=$user["name"]?>
  </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
  <?php
  if ($lang =="ar"){
      ?>
      <a class="dropdown-item" href="change_lang.php?lang=en">English</a>
      <?php
  }else{
    ?>
    <a class="dropdown-item" href="change_lang.php?lang=ar">????????????????????????</a>
    <?php
  }
  ?>  

    <a class="dropdown-item" href="logout.php">Logout</a>
  </div>
</li>
</ul>

  </div>
</nav>
