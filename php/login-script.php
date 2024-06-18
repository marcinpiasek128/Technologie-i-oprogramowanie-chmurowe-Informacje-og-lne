<?php
session_start();
require("connect.php");

if ($conn === false) {
    echo "Error: " . print_r(sqlsrv_errors(), true);
} else {
    if (isset($_POST['but_submit'])) {
        $working = true;
        @$login = $_POST['txt_uname'];
        @$pass = $_POST['txt_pwd'];

        // Check username
        $sql = "SELECT ID_User FROM data WHERE Username = ?";
        $params = array($login);
        $result = sqlsrv_query($conn, $sql, $params);

        if ($result === false || sqlsrv_has_rows($result) === false) {
            $working = false;
            $_SESSION['e_txt_uname'] = "Podano zły login!";
        }

        // Check password
        $sql = "SELECT ID_User FROM data WHERE Password = ?";
        $params = array($pass);
        $result = sqlsrv_query($conn, $sql, $params);

        if ($result === false || sqlsrv_has_rows($result) === false) {
            $working = false;
            $_SESSION['e_txt_pwd'] = "Podano złe hasło!";
        }

        // Verify both username and password
        $sql = "SELECT * FROM data WHERE Username = ? AND Password = ?";
        $params = array($login, $pass);
        $result = sqlsrv_query($conn, $sql, $params);

        if ($result === false || sqlsrv_has_rows($result) === false) {
            $working = false;
        }

        // Check for ban status
        $sql = "SELECT ban FROM data WHERE Username = ? AND Password = ?";
        $result = sqlsrv_query($conn, $sql, $params);

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            if ($row["ban"] == 1) {
                $working = false;
                $_SESSION['e_txt_ban'] = "Konto zablokowane!";
            }
        }

        if ($working == true) {
            $_SESSION['loggedin'] = true;
            $result = sqlsrv_query($conn, $sql, $params);
            $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
            $_SESSION['ID_User'] = $row['ID_User'];
            $_SESSION['Username'] = $row['Username'];

            if ($_SESSION['Username'] == 'admin') {
                header('Location: adminpage.php');
            } else {
                header('Location: userpage.php');
            }
        }
        sqlsrv_close($conn);
    }
}
?>
