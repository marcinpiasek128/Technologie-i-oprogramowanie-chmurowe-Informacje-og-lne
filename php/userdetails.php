<?php
require("connect.php");

session_start();

// Validate the session ID
if (!isset($_SESSION['ID_User']) || !is_numeric($_SESSION['ID_User']) || $_SESSION['ID_User'] <= 0) {
    die("Invalid user ID.");
}

$x = intval($_SESSION['ID_User']);
$query = "SELECT Picture FROM data WHERE ID_User = ?";
$params = array($x);
$stmt = sqlsrv_query($conn, $query, $params);

if($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$avatar = null;
while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $avatar = $row['Picture'];
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

if($avatar !== null) {
    // Check if the avatar data is valid
    if (base64_encode($avatar)) {
        echo '<img class="avatar" src="data:image/jpeg;base64,' . base64_encode($avatar) . '" />';
    } else {
        echo "Failed to encode avatar data.";
    }
} else {
    echo "Avatar not found.";
}
?>
