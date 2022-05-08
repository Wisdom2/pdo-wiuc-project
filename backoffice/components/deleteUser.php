<?php
     include("../includes/DatabaseConnect.php");
     include("../model/RegisterUser.php");
     $db = new DatabaseConnect();
     $registerUser = new RegisterUser($db->connect());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $registerUser->deleteSelectedRegister($_POST['delete_id']);
    } catch (PDOException $e) {
            throw $e;
    }
    header('Location:' . '../register.php');
}



?>