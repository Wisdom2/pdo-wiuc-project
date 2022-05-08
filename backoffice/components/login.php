<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("../includes/DatabaseConnect.php");
include("../model/RegisterUser.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    unset($_SESSION['error_msg']);
    unset($_SESSION['success']);
    unset($_SESSION['status']);

    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);


    try {
        $db = new DatabaseConnect();
     $registerUser = new RegisterUser($db->connect());
     $Login = $registerUser->Login($email, $password);
  
     if(empty($Login)) {
        $_SESSION['error_msg'] = "Invalid credentials";
        header('Location:' . '../../login.php');
     } else {
         $_SESSION['success'] = 'Login sucessful';
         $_SESSION['user'] = $Login;
         header('Location:' . '../register.php');
     }
    } catch (PDOException $e) {
            throw $e;
    }
}



?>