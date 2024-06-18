# Technologie-i-oprogramowanie-chmurowe-Projekt
Kalkulator walut Aplikacja, która na podstawie kursów walut przelicza kwoty między wybranymi walutami, pozwala śledzić historię kursów, etc.

Kwerenda do utworzenia bazy danych:
CREATE DATABASE `calc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci */

Następnie bazę danych należy zaimportować z pliku: calc.sql

Ze względów bezpieczeństwa został usunięty plik connect.php z folderu php, który zawierał połączenie z bazą, aby aplikacja działała należy ten plik utworzyć i wypełnić poprawnymi danymi.
Zawartość connect.php:

<?php
@$server='localhost';
@$login='root'; 
@$password='';
@$database='calc';
@$data='data';
@$conn=mysqli_connect($server,$login,$passowrd,$database) or die ("Wystąpił błąd połączenia z bazą danych");
?>
