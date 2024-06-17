<?php
require("connect.php");
session_start();
$x = $_SESSION['ID_User'];

if(!empty($_FILES["image"]["name"])) { 
    $fileName = basename($_FILES["image"]["name"]); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
    $allowTypes = array('jpg');

    if(in_array($fileType, $allowTypes)){ 
        $image = $_FILES['image']['tmp_name']; 
        $avatar = addslashes(file_get_contents($image)); 
        $reg="UPDATE data SET Picture='$avatar' WHERE ID_User='$x'";
        $result = $conn->query($reg);
        header("Location: settings.php");
    }
}
else
{
    header("Location: settings.php");
}
?>