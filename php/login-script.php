<?php
session_start();
require("connect.php");

if ($conn === false) {
    echo "Error: " . print_r(sqlsrv_errors(), true);
    exit();
}

if (isset($_POST['but_submit'])) {
    $working = true;
    $login = $_POST['txt_uname'] ?? '';
    $pass = $_POST['txt_pwd'] ?? '';

    // Verify both username and password
    $sql = "SELECT * FROM data WHERE Username = ? AND Password = ?";
    $params = array($login, $pass);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        echo "Error: " . print_r(sqlsrv_errors(), true);
        exit();
    }

    if (sqlsrv_has_rows($result) === false) {
        $working = false;
        $_SESSION['e_txt_uname'] = "Podano zły login lub hasło!";
    } else {
        $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

        // Check for ban status
        if ($row['ban'] == 1) {
            $working = false;
            $_SESSION['e_txt_ban'] = "Konto zablokowane!";
        }

        if ($working == true) {
            $_SESSION['loggedin'] = true;
            $_SESSION['ID_User'] = $row['ID_User'];
            $_SESSION['Username'] = $row['Username'];

            if ($_SESSION['Username'] == 'admin') {
                header('Location: adminpage.php');
            } else {
                header('Location: userpage.php');
            }
            exit();
        }
    }
}

sqlsrv_close($conn);
?>
