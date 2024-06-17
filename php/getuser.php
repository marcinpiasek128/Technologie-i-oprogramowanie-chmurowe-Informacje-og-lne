<?php
    require("connect.php");

    $x = $_SESSION['Username'];       
    $sql = "SELECT * FROM data WHERE Username!='$x' ORDER BY ID_User ASC";
    $result = $conn->query($sql);

    echo "<table class='table'>";
        echo "<tr>";
            echo "<th>";
                echo "ID";
            echo "</th>";
            echo "<th>";
                echo "Nazwa";
            echo "</th>";
            echo "<th>";
                echo "Email";
            echo "</th>";
            echo "<th>";
                echo "Zablokuj konto";
            echo "</th>";
            echo "<th>";
                echo "Odblokuj konto";
            echo "</th>";
        echo "</tr>";
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
                echo "<td>";
                    echo $row["ID_User"];
                echo "</td>";
                echo "<td>";
                    echo $row["Username"];
                echo "</td>";
                echo "<td>";
                    echo $row["Email"];
                echo "</td>";
                echo "<td>";
                    echo "<form action='ban.php' method='POST'>";
                        echo "<input value='$row[ID_User]' name='block' hidden/>";
                        echo "<input type='submit' value='Zablokuj $row[Username]'>";
                    echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form action='unban.php' method='POST'>";
                    echo "<input value='$row[ID_User]' name='unblock' hidden/>";
                    echo "<input type='submit' value='Odblokuj $row[Username]' >";
                echo "</form>";
                echo "</td>";
            echo "</tr>";
        }
    } 
    else {
        echo "Brak Użytkowników";
    }

    
    echo "</table>";
?>