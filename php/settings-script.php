<?php
session_start();
require("connect.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    if (isset($_POST['but_submit'])) {
        $login = $_POST['txt_uname'];
        $haslo = $_POST['txt_pwd'];
        $fajna_zmienna = $_SESSION['ID_User'];

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $stmt = $conn->prepare("UPDATE data SET Username = ?, Password = ? WHERE ID_User = ?");
            $stmt->bind_param("ssi", $login, $haslo, $fajna_zmienna);
            $stmt->execute();
            $stmt->close();
        }
    }
}
$conn->close();
?>
