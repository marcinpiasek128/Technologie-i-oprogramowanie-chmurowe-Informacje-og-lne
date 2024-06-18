<?php
session_start();
require_once("connect.php");

$working = true;
$email = $_POST['txt_email'];
$passwd = $_POST['txt_pwd'];
$login = $_POST['txt_uname'];
$confirm = $_POST['txt_confirmpwd'];

@$cond_mail = preg_match('/^[a-z0-9._%-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i', $email);
@$cond_passwd = preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[\!\@\#\$\%\^\&\*\(\)\_\+\-\=])(?=.*[A-Z])(?!.*\s).{8,20}$/i', $passwd);
@$cond_login = preg_match('/^[A-Za-z0-9]+$/', $login);

if (isset($_POST['but_submit'])) {
    if ((strlen($login) < 3) || strlen($login) > 20) {
        $working = false;
        $_SESSION['e_txt_uname'] = "Login musi posiadać od 3 do 20 znaków!";
    }

    if (!$cond_login) {
        $working = false;
        $_SESSION['e_txt_uname'] = "Login musi składać się tylko z cyfr i liter!";
    }

    if (!$cond_mail) {
        $working = false;
        $_SESSION['e_txt_email'] = "Podaj poprawny E-mail!";
    }

    if (!$cond_passwd) {
        $working = false;
        $_SESSION['e_txt_pwd'] = "Hasło musi się składać z z jednej litery małej, jednej dużej, cyfry, znaku specjalnego i długość musi wynosić od 8 do 20 znaków!";
    }

    if ($passwd != $confirm) {
        $working = false;
        $_SESSION['e_txt_pwd'] = "Podane hasła różnią się!";
    }

    if ($working) {
        $stmt = $conn->prepare("SELECT ID_User FROM data WHERE Username = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->store_result();
        $amount_of_nicknames = $stmt->num_rows;
        $stmt->close();

        if ($amount_of_nicknames > 0) {
            $working = false;
            $_SESSION['e_txt_uname'] = "Ten login jest już zajęty!";
        }
    }

    if ($working) {
        $stmt = $conn->prepare("SELECT ID_User FROM data WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $amount_of_emails = $stmt->num_rows;
        $stmt->close();

        if ($amount_of_emails > 0) {
            $working = false;
            $_SESSION['e_txt_email'] = "Ten e-mail jest już używany!";
        }
    }

    if ($working) {
        $hashed_password = password_hash($passwd, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO data (Username, Email, Password, rank_role, ban) VALUES (?, ?, ?, 'Użytkownik', 0)");
        $stmt->bind_param("sss", $login, $email, $hashed_password);
        $stmt->execute();
        $stmt->close();

        echo '<script>alert("Gratulacje ' . $login . '! Rejestracja przebiegła pomyślnie. Możesz już zalogować się na swoje konto!")</script>';
    }
}

$conn->close();
?>
