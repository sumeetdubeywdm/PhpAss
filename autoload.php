<?php session_start(); 
require_once("setting.php");
spl_autoload_register(function($className){
        // require_once("classes/$className.php");
        require_once("public/controllers/$className.php");
 });
    $getUser=new User($db);
    $getUserLoginDeatils=new Login($db);
    $newUserRegistration = new Register($db);
    $userLogout = new Logout($db);
    $fetchUserDetails = new Fetch($db);
    $userForgotPassword = new ForgotPasswordCtrl($db);
    $updatedPassword = new ResetPassCtrl($db);
?>