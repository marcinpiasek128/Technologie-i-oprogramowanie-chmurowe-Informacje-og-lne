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
        $working = true;
        @$login = $_POST['txt_uname'];
        @$pass = $_POST['txt_pwd'];
        
        $result = $conn->query("SELECT ID_User FROM $data WHERE Username='$login'");
        
        $amount_of_nicknames = $result->num_rows;
        
        if($amount_of_nicknames == 0)
        {
            $working = false;
            $_SESSION['e_txt_uname']="Podano zły login!";
        }
        $result = $conn->query("SELECT ID_User FROM $data WHERE Password='$pass'");
        $amount_of_passwords = $result->num_rows;
        
        if($amount_of_passwords == 0)
        {
            $working = false;
            $_SESSION['e_txt_pwd']="Podano złe hasło!";
        }

        $reg="SELECT * FROM $data WHERE Username='$login' AND Password='$pass'";
        $result=$conn->query($reg);
        $amount=$result->num_rows;
        if($amount == 0)
        {
            $working = false;
        }

        $sql = "SELECT ban FROM data WHERE Username='$login' AND Password='$pass'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            if($row["ban"] == 1)
            {
                $working = false;
                $_SESSION['e_txt_ban']="Konto zablokowane!";
            }
        }

        if ($working == true)
        {
            $_SESSION['loggedin']=true;
            $reg="SELECT * FROM $data WHERE Username='$login' AND Password='$pass'";
            $res = mysqli_query($conn,$reg);
            $row=$res->fetch_assoc();
            $_SESSION['ID_User']=$row['ID_User'];
            $_SESSION['Username']=$row['Username'];
            
            if($_SESSION['Username'] == 'admin')
            {
                header('Location: adminpage.php');
            }
            else
            {
                header('Location: userpage.php');
            }
        }
        $conn->close();
    }
}
?>