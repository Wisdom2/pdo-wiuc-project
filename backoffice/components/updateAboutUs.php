<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("../includes/DatabaseConnect.php");
include("../model/AboutUs.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    unset($_SESSION['error_msg']);
    unset($_SESSION['success']);
    unset($_SESSION['status']);

    $id = strip_tags($_POST['id']);
    $title = strip_tags($_POST['title']);
    $subtitle = strip_tags($_POST['subtitle']);
    $description = strip_tags($_POST['description']);
    $link = strip_tags($_POST['link']);
   
    if(empty($title) || empty($subtitle) || empty($description) || empty($link)) {
        $_SESSION['error_msg'] = "Please fill all fields on about us";
        header('Location:' . '../aboutus.php');

        return false;
    }

    try {
        $db = new DatabaseConnect();
        $aboutUs = new AboutUs($db->connect());

        $aboutUs->updateRegister($id, $title, $subtitle, $description, $link);
     $_SESSION['success'] = "About us updated successfully!";
    } catch (PDOException $e) {
            throw $e;
    }
    header('Location:' . '../aboutus.php');
}



?>