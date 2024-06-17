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
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("idssds", $user_id, $amount, $fromCurrency, $toCurrency, $result, $current_date);

            if ($stmt->execute()) {
                echo "Success";
            } else {
                echo "Error executing query: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing query: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Invalid data: " . json_encode($_POST);
    }
} else {
    echo "Invalid request method.";
}
?>