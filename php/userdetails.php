<?php
require("connect.php");
session_start();

$x = $_SESSION['ID_User'];
$query = "SELECT Picture FROM data WHERE ID_User = ?";
$params = array($x);
$result = sqlsrv_query($conn, $query, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$avatar = null;
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $avatar = $row['Picture'];
}

if ($avatar !== null) {
    echo '<img class="avatar" src="data:image/jpg;base64,' . base64_encode($avatar) . '" />';
} else {
    echo 'No image found for this user.';
}

sqlsrv_close($conn);
?>
