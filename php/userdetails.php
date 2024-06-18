<?php
require("connect.php");

session_start();
$x = $_SESSION['ID_User'];
$query = "SELECT Picture FROM data WHERE ID_User = ?";
$params = array($x);
$stmt = sqlsrv_query($conn, $query, $params);

if($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $avatar = $row['Picture'];
}

if(isset($avatar)) {
    echo '<img class="avatar" src="data:image/jpg;charset=utf8;base64,' . base64_encode($avatar) . '" />';
} else {
    echo "Avatar not found.";
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
