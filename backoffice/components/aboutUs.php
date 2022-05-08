<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("../includes/DatabaseConnect.php");
include("../model/AboutUs.php");

if(isset($_POST['aboutUsBtn'])) {
    var_dump($_POST['title']);
            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $links = $_POST['links'];
            $descriptions = $_POST['description'];

        if(empty($title) || empty($subtitle) || empty($links) || empty($descriptions)) {
            $_SESSION['error_msg'] = "Please fill all fields";
            header('Location:' . '../aboutus.php');
        }
        else {

            try {
               
                $db = new DatabaseConnect();
                $aboutUs = new AboutUs($db->connect());

                
                $aboutUs->postAboutUs($title, $subtitle, $descriptions, $links); 
                $_SESSION['success'] = "Data saved successfully!";
                } catch (PDOException $e) {
                        throw $e;
                }
                header('Location:../aboutus.php');
     }

} 

