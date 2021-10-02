<?php
    //filter validation
    // var_dump($_POST);
    session_start();
    if (!empty($_SESSION["user"]) && $_SESSION["user"]["role"] =="admin") {
        $user = $_SESSION["user"];

        $errors =[];
        $old_values =["name"=>null ,"email"=>null ,"mobile"=>null];


        if (empty($_REQUEST['name'])) $errors["name"] = "Name is Required";
        else $old_values["name"] =$_REQUEST['name'];
        
        if (empty($_REQUEST['email'])) $errors["email"] = "Email is Required";
        else $old_values["email"] =$_REQUEST['email'];
        
        if (empty($_REQUEST['mobile'])) $errors["mobile"] = "Mobile is Required";
        else $old_values["mobile"] =$_REQUEST['mobile'];

        if (empty($_REQUEST['pass']) ||empty($_REQUEST['pass-confirmation'])  ) $errors["pass"] = "Password and Confirm Passowrd is Required";
        else if($_REQUEST['pass-confirmation'] != $_REQUEST['pass']){
            $errors["pass-confirmation"] = "Password and Confirm Password not matched";
        }

        // $name = htmlspecialchars($_POST["name"]);
        $name = filter_var(trim( $_REQUEST['name']) ,FILTER_SANITIZE_STRING);
        // $name =filter_var( trim( $_REQUEST['name'])  ,FILTER_SANITIZE_NUMBER_INT);
        // $name =filter_var( trim( $_REQUEST['name'])  ,FILTER_SANITIZE_SPECIAL_CHARS);

        $email = filter_var(trim( $_REQUEST['email']) ,FILTER_SANITIZE_EMAIL);
        $mobile = filter_var(trim( $_REQUEST['mobile']) ,FILTER_SANITIZE_STRING);
        $pw = htmlspecialchars($_POST['pass']);
        // $pwc = htmlspecialchars($_POST['pass-confirmation']);
        $gender = $_POST['gender'];
        $role = $_POST['role'];


        if ( empty($errors["email"] ) &&  ! filter_var($email ,FILTER_VALIDATE_EMAIL)) $errors["email"] = "Email Invalid Formate please enter  xx@yyy.cc";
        // echo  $name;
        // echo  $email;
        if(empty($errors)){
            $pw =md5($pw);
            $qry ="insert into users(email, mobile, name, password, gender ,role) values ('$email', '$mobile', '$name', '$pw', '$gender' ,'$role')";
            require_once("config.php");
            $cn = mysqli_connect(HOST_NAME ,DB_USER_NAME ,DB_PW ,DB_NAME ,DB_PORT);
            $rslt =mysqli_query($cn , $qry);
            // echo mysqli_error($cn);
            mysqli_close($cn);           
            header("location:users.php");        
        }else{
            $_SESSION["errors"] =$errors;
            $_SESSION["old_values"] =$old_values;
            header("location:users.php");        }

    }else{
        header("location:home.php");
    }









