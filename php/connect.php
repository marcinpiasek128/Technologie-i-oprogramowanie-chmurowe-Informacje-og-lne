<?php
@$server='tiochkalkulator-sql.mysql.database.azure.com';
@$login='wmdhxfuygy';
@$password='$LozVGJbooFxAK0N';
@$database='calc';
@$data='data';
@$conn = mysqli_real_connect($server,$login,$passowrd,$database, 3306) or die ("Wystąpił błąd połączenia z bazą danych");
?>
