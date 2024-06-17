<?php
require("connect.php");
if (isset($_POST["block"]))
    {
        $ban_id = $_POST['block'];
        $sql = "UPDATE data SET ban='1' WHERE ID_User = '$ban_id'";
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