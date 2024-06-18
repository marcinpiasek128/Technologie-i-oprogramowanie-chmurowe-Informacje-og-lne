<?php
session_start();
require("connect.php");

// Check if connection was successful
if ($conn === false) {
    die("Error: " . print_r(sqlsrv_errors(), true));
} else {
    if (isset($_POST['but_submit'])) {
        $login = $_POST['txt_uname'];
        $haslo = $_POST['txt_pwd'];
        $fajna_zmienna = $_SESSION['ID_User'];

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $sql = "UPDATE data SET Username = ?, Password = ? WHERE ID_User = ?";
            $params = array($login, $haslo, $fajna_zmienna);
            $stmt = sqlsrv_query($conn, $sql, $params);

            if ($stmt === false) {
                die("Error executing query: " . print_r(sqlsrv_errors(), true));
            }

            sqlsrv_free_stmt($stmt);
        }
    }
}

sqlsrv_close($conn);
?>
