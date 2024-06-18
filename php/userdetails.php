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

$avatar = null;
while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $avatar = $row['Picture'];
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

if($avatar !== null) {
     echo '<img class="avatar" src="data:image/jpeg;base64,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
} else {
    echo "Avatar not found.";
}
?>
