<?php

    session_start();
    unset($_SESSION['name']) ;
    unset($_SESSION['id']) ;
    unset($_SESSION['email_id']); 
    unset($_SESSION['role_name']) ;
    unset($_SESSION['is_loggedin']);
    unset($_SESSION['profile_image']);
    session_destroy();
    header('location:login.php');
?>