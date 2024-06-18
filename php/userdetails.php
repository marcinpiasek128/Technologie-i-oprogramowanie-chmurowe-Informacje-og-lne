<?php
require("connect.php");
session_start();

// Check if session variable is set
if (!isset($_SESSION['ID_User'])) {
    die('User not logged in.');
}

$x = $_SESSION['ID_User'];
$query = "SELECT Picture FROM data WHERE ID_User = ?";
$params = array($x);
$result = sqlsrv_query($conn, $query, $params);

// Check for query errors
if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Initialize avatar variable
$avatar = null;
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $avatar = $row['Picture'];
}

// Check if avatar is not null and display the image
if ($avatar !== null) {
    // Display the image
    echo '<img class="avatar" src="data:image/jpg;base64,' . base64_encode($avatar) . '" />';
} else {
    echo 'No image found for this user.';
}

sqlsrv_close($conn);
?>
