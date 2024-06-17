<?php
session_start();
require("connect.php");

if ($conn->connect_errno!=0)
{
    echo "Error: ".$conn->connect_errno;
}
else
{
    if(isset($_POST['but_submit']))
    {
        @$login = $_POST['txt_uname'];
        @$haslo = $_POST['txt_pwd'];
        $fajna_zmienna=$_SESSION['ID_User'];
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            $reg="UPDATE $data SET Username='$login', Password='$haslo' WHERE ID_User='$fajna_zmienna'";
            $result=$conn->query($reg);
        }
    }
}
$conn->close();
?>