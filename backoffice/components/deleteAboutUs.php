<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("../includes/DatabaseConnect.php");
include("../model/AboutUs.php");
$db = new DatabaseConnect();
$aboutUs = new AboutUs($db->connect());

if (isset($_POST['deletebtn'])) {
    try {
        $aboutUs->deleteAboutUs($_POST['delete_id']);
        $_SESSION['success'] = "data deleted successfully!";
    } catch (PDOException $e) {
            throw $e;
    }
    header('Location:' . '../aboutus.php');
}



?>