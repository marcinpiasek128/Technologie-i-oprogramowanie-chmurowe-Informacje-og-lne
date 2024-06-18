<?php
// Plik: php/save_conversion_history.php
session_start();
require("connect.php"); // Plik do połączenia z bazą danych

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['ID_User']) && !empty($_POST['amount']) && !empty($_POST['fromCurrency']) && !empty($_POST['toCurrency']) && !empty($_POST['result'])) {
        $user_id = $_SESSION['ID_User'];
        $amount = $_POST['amount'];
        $fromCurrency = $_POST['fromCurrency'];
        $toCurrency = $_POST['toCurrency'];
        $result = $_POST['result'];
        $current_date = date('Y-m-d H:i:s');

        $sql = "INSERT INTO search (user_id, amount, from_currency, to_currency, result, date) VALUES (?, ?, ?, ?, ?, ?)";
        $params = array($user_id, $amount, $fromCurrency, $toCurrency, $result, $current_date);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            echo "Error executing query: " . print_r(sqlsrv_errors(), true);
        } else {
            echo "Success";
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    } else {
        echo "Invalid data: " . json_encode($_POST);
    }
} else {
    echo "Invalid request method.";
}
?>
