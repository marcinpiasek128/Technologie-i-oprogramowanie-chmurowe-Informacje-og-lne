<?php
require("connect.php");
if (isset($_POST["unblock"]))
    {
        $ban_id = $_POST['unblock'];
        $sql = "UPDATE data SET ban='0' WHERE ID_User = '$ban_id'";
        mysqli_query($conn,$sql);

        if ($conn->query($sql) === TRUE) {
            header("Location: adminpage.php");
        } 
        else 
        {
              
        }
    }
    else
    {

    }
?>