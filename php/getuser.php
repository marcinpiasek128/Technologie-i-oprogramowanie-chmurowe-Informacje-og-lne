<?php
require("connect.php");

session_start();
$x = $_SESSION['Username'];
$sql = "SELECT * FROM data WHERE Username != ? ORDER BY ID_User ASC";
$params = array($x);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "<table class='table'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Nazwa</th>";
echo "<th>Email</th>";
echo "<th>Zablokuj konto</th>";
echo "<th>Odblokuj konto</th>";
echo "</tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["ID_User"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["Username"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["Email"]) . "</td>";
    echo "<td>";
    echo "<form action='ban.php' method='POST'>";
    echo "<input type='hidden' value='" . htmlspecialchars($row["ID_User"]) . "' name='block' />";
    echo "<input type='submit' value='Zablokuj " . htmlspecialchars($row["Username"]) . "'>";
    echo "</form>";
    echo "</td>";
    echo "<td>";
    echo "<form action='unban.php' method='POST'>";
    echo "<input type='hidden' value='" . htmlspecialchars($row["ID_User"]) . "' name='unblock' />";
    echo "<input type='submit' value='Odblokuj " . htmlspecialchars($row["Username"]) . "'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";

sqlsrv_free_stmt($stmt);
?>
