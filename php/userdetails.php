<?php
    require("connect.php");

    $x = $_SESSION['ID_User'];
    $query = "SELECT Picture FROM data WHERE ID_User='$x'";
    $result = $conn->query($query);

    while($row = $result->fetch_array())
    {
        @$avatar = $row['Picture'];
    }
    echo '<img class="avatar" src="data:image/jpg;charset=utf8;base64,'.base64_encode($avatar).'" />';
?>
