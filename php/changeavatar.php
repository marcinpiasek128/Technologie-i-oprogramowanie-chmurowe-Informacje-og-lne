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
        $avatar = file_get_contents($image); 

        $query = "UPDATE data SET Picture = ? WHERE ID_User = ?";
        $params = array($avatar, $x);
        $stmt = sqlsrv_query($conn, $query, $params);

        if($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            header("Location: settings.php");
        }
    }
} else {
    header("Location: settings.php");
}

sqlsrv_close($conn);
?>
