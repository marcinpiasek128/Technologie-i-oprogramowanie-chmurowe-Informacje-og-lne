<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:kalkulatorwalut-server.database.windows.net,1433; Database = calc", "kalkulatorwalut-server-admin", "Md2l$ea5riJj2lAx");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "kalkulatorwalut-server-admin", "pwd" => "Md2l$ea5riJj2lAx", "Database" => "calc", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:kalkulatorwalut-server.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>
