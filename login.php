<?php
    // validate and filter
    session_start();
    $errors =[];
    
    if (empty($_POST["email"])) {
        $errors["empty_email"] = "Email is Required";
    } 
    if (empty($_POST["pass"])) {
        $errors["empty_pass"] = "Password is Required";
    }
    
    if(empty($errors))
    {
   
        $email =filter_var( $_POST["email"] ,FILTER_SANITIZE_EMAIL);
        
        $pass =md5(htmlspecialchars( $_POST["pass"]));

        $qry ="select id, email, mobile, name,  gender, role,  avtar, created_at from users where email='$email' and password='$pass'  and active=1";

        require_once("config.php");
        $cn = mysqli_connect(HOST_NAME ,DB_USER_NAME ,DB_PW ,DB_NAME ,DB_PORT);
        $rslt =mysqli_query($cn , $qry);

        if ($row = mysqli_fetch_assoc($rslt)){   
            // var_dump($row)     ;
            $_SESSION["user"] =$row;        
            header("location:home.php");
        }else{
            $errors["invalid_login"] ="Invalid Email or Password";
            $_SESSION["errors"] =$errors;
            header("location:index.php?email=$email" );
        }
        
        mysqli_close($cn);
    }else{
        $_SESSION["errors"] =$errors;
        header("location:index.php" );
    }

