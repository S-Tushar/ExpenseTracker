<?php

    session_start();
    unset($_SESSION['name']) ;
    unset($_SESSION['id']) ;
    unset($_SESSION['email_id']); 
    unset($_SESSION['role_name']) ;
    $_SESSION['is_loggedin']=0;
    session_destroy();
    header('location:login.php');
?>