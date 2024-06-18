<?php
session_start();
require_once("connect.php");

$working=true;
@$cond_mail= preg_match('/^[a-z0-9._%-]+@[a-z0-9.-]+.[a-z]{2,4}$/i',$email = $_POST['txt_email']);
@$cond_passwd= preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[\!\@\#\$\%\^\&\*\(\)\_\+\-\=])(?=.*[A-Z])(?!.*\s).{8,20}$/i',$passwd=$_POST['txt_pwd']);
@$cond_login = preg_match('/^[A-Za-z0-9]+$/',$login=$_POST['txt_uname']);
@$confirm=$_POST['txt_confirmpwd'];

if(isset($_POST['but_submit']))
{
    if((strlen($login)<3) || strlen($login)>20)
    {
        $working=false;
        $_SESSION['e_txt_uname']="Login musi posiadać od 3 do 20 znaków!";
    }
    
    if(!$cond_login)
    {
        $working=false;
        $_SESSION['e_txt_uname']="Login musi składać się tylko z cyfr i liter!";
    }
    
    if(!$cond_mail)
    {
        $working=false;
        $_SESSION['e_txt_email']="Podaj poprawny E-mail!";
    }
    
    if(!$cond_passwd)
    {
        $working=false;
        $_SESSION['e_txt_pwd']="Hasło musi się składać z z jednej litery małej, jednej dużej, cyfry, znaku specjalnego i długość musi wynosić od 8 do 20 znaków!";
    }
    
    if($passwd != $confirm)
    {
        $working=false;
        $_SESSION['e_txt_pwd']="Podane hasła różnią się!";
    }
    
    $result = $conn->query("SELECT ID_User FROM $data WHERE Username='$login'");
    
    $amount_of_nicknames = $result->num_rows;
    
    if($amount_of_nicknames > 0)
    {
        $working = false;
    }
    
    $result = $conn->query("SELECT ID_User FROM $data WHERE Email='$email'");
    
    $amount_of_emails = $result->num_rows;
    
        if($amount_of_emails > 0)
    {
        $working = false;
    }
    
    if($working == true)
    {
        $reg="INSERT INTO $data (Username, Email, Password, rank_role, ban) Values('$login','$email','$passwd','Użytkownik','0')";
        $res = mysqli_query($conn,$reg);
        echo '<script>alert("Gratulacje "+$login"+! Rejestracja przebiegła pomyślnie. Możesz już zalogować się na swoje konto!")</script>';
    }
}

$conn->close();
?>
