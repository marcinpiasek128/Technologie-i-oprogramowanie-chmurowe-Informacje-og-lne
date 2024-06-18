<?php
session_start();
require("connect.php");

try {
    $conn = new PDO("sqlsrv:server = tcp:<your_server_name>,1433; Database = <your_database_name>", "<your_username>", "<your_password>");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(isset($_POST['but_submit']))
    {
        $working = true;
        $login = $_POST['txt_uname'] ?? '';
        $pass = $_POST['txt_pwd'] ?? '';

        // Use parameterized queries to prevent SQL injection
        $stmt = $conn->prepare("SELECT ID_User FROM data WHERE Username = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $amount_of_nicknames = $stmt->rowCount();

        if($amount_of_nicknames == 0)
        {
            $working = false;
            $_SESSION['e_txt_uname']="Podano zły login!";
        }

        $stmt = $conn->prepare("SELECT ID_User FROM data WHERE Password = :pass");
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        $amount_of_passwords = $stmt->rowCount();

        if($amount_of_passwords == 0)
        {
            $working = false;
            $_SESSION['e_txt_pwd']="Podano złe hasło!";
        }

        $stmt = $conn->prepare("SELECT * FROM data WHERE Username = :login AND Password = :pass");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        $amount = $stmt->rowCount();

        if($amount == 0)
        {
            $working = false;
        }

        $stmt = $conn->prepare("SELECT ban FROM data WHERE Username = :login AND Password = :pass");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $row) {
            if($row["ban"] == 1)
            {
                $working = false;
                $_SESSION['e_txt_ban']="Konto zablokowane!";
            }
        }

        if ($working == true)
        {
            $_SESSION['loggedin'] = true;
            $stmt = $conn->prepare("SELECT * FROM data WHERE Username = :login AND Password = :pass");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':pass', $pass);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['ID_User'] = $row['ID_User'];
            $_SESSION['Username'] = $row['Username'];
            
            if($_SESSION['Username'] == 'admin')
            {
                header('Location: adminpage.php');
            }
            else
            {
                header('Location: userpage.php');
            }
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
