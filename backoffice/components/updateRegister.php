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

    $id = strip_tags($_POST['id']);
    $user_name = strip_tags($_POST['username']);
    $user_type = strip_tags($_POST['usertype']);
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
   
    if(empty($user_name) || empty($user_type) || empty($email) || empty($password)) {
        $_SESSION['error_msg'] = 'Please fill all fields';

        header('Location:' . '../register.php');

        return false;
    }

    try {
        $db = new DatabaseConnect();
     $registerUser = new RegisterUser($db->connect());
     $registerUser->updateRegister($id, $user_name, $user_type, $email, $password);
     $_SESSION['success'] = "Register updated successfully!";
    } catch (PDOException $e) {
            throw $e;
    }
    header('Location:' . '../register.php');
}



?>