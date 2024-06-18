<?php
@$server='localhost';
@$login='root';
@$password='';
@$database='calc';
@$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, "DigiCertGlobalRootCA.crt", NULL, NULL)
mysqli_real_connect($conn, $server, $login, $passowrd, $database, 3306, MYSQL_CLIENT_SSL);
if (mysqli_connect_errno($conn)) { 
  die('Nie udało się połączyć z bazą danych: '.mysqli_connect_errno()); 
}
?>
