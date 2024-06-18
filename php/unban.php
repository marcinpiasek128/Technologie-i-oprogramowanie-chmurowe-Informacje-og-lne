<?php
require("connect.php");

if (isset($_POST["unblock"])) {
    $ban_id = $_POST['unblock'];
    $sql = "UPDATE data SET ban = 0 WHERE ID_User = ?";

    // Prepare and execute the query
    $stmt = sqlsrv_prepare($conn, $sql, array(&$ban_id));

    if (sqlsrv_execute($stmt)) {
        header("Location: adminpage.php");
    } else {
        // Error handling (if needed)
        // echo "Error: " . sqlsrv_errors();
    }
} else {
    // Handle case where unblock is not set (if needed)
}
?>
