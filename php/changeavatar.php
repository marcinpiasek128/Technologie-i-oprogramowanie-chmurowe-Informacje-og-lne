<?php
require("connect.php");
session_start();
$x = $_SESSION['ID_User'];

if (!empty($_FILES["image"]["name"])) {
    $fileName = basename($_FILES["image"]["name"]);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowTypes = array('jpg');

    if (in_array($fileType, $allowTypes)) {
        $image = $_FILES['image']['tmp_name'];
        $avatar = file_get_contents($image);
        // Converting the image content to hexadecimal representation
        $avatar = bin2hex($avatar);

        $sql = "UPDATE data SET Picture = CONVERT(VARBINARY(MAX), ?) WHERE ID_User = ?";
        $params = array($avatar, $x);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            header("Location: settings.php");
            exit();
        }
    } else {
        // If file type is not allowed
        $_SESSION['e_image'] = "Allowed file type is .jpg";
        header("Location: settings.php");
        exit();
    }
} else {
    header("Location: settings.php");
    exit();
}
sqlsrv_close($conn);
?>
