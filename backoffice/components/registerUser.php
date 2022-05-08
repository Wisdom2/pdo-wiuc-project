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

    $user_name = strip_tags($_POST['username']);
    $user_type = strip_tags($_POST['usertype']);
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);

    if($_POST['password'] != $_POST['confirmpassword']) {
        $_SESSION['error_msg'] = 'Password mismatch';
        header('Location:' . '../register.php');
        return false;
    }

    if(empty($user_name) || empty($user_type) || empty($email) || empty($password)) {
        $_SESSION['error_msg'] = 'Please fill all fields';

        header('Location:' . '../register.php');

        return false;
    }



    try {
        $db = new DatabaseConnect();
     $registerUser = new RegisterUser($db->connect());
    $registerUser->register($user_name, $email, $user_type, $password);
     $_SESSION['success'] = "New register added successfully!";
    } catch (PDOException $e) {
            throw $e;
    }
    header('Location:' . '../register.php');
}



?>