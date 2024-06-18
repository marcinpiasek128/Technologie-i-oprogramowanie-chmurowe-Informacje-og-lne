<?php
require("connect.php");

$x = $_SESSION['ID_User'];
$query = "SELECT Picture FROM data WHERE ID_User = ?";
$params = array($x);
$result = sqlsrv_query($conn, $query, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    @$avatar = $row['Picture'];
}

echo '<img class="avatar" src="data:image/jpg;charset=utf8;base64,' . base64_encode($avatar) . '" />';
?>
