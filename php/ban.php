<?php
require("connect.php");

if (isset($_POST["block"])) {
    $ban_id = $_POST['block'];
    $sql = "UPDATE data SET ban = '1' WHERE ID_User = ?";

    // Prepare and execute the statement
    $params = array($ban_id);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header("Location: adminpage.php");
    }
}
?>
