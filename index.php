<?php
session_start();
require("php/connect.php")
?>
<!DOCTYPE html>
<html lang="PL-pl">

<head>
    <title>Kalkulator</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/kalkulatorstyle.css" />
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div id="all">
        <div id="header">
            <div id="logo">
                <a href="index.php" class="logolink">
                    <span class="logotekst1">Kalkulator Walut</span>
                </a>
            </div>
        </div>
        <div id="navigation">
            <ol>
                <li><a href="index.php">Strona Główna</a></li>
               
                <?php
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
                {
                    echo "<li><a href="."#".">".$_SESSION['Username']."</a>
                        <ul>
                            <li><a href="?><?php
                                if($_SESSION['Username']=='admin')
                                {
                                    echo "php/adminpage.php";
                                }
                                else
                                {
                                    echo "php/userpage.php";
                                }
                            ?><?php echo">Profil</a></li>
                            <li><a href="."php/settings.php".">Ustawienia</a></li>
                            <li><a href="."php/logout.php".">Wyloguj</a></li>
                            </ul></li>";
                }
                else
                {
                    echo "<li><a href="."php/login.php".">Logowanie</a></li>";
                }
                ?>
            </ol>
        </div>
        <div id="content">
             <div class="container">
				<h1>Kalkulator Walut</h1>
				<div class="calculator">
					<div class="input-group">
						<label for="amount">Kwota:</label>
						<input type="number" id="amount" placeholder="Wpisz kwotę">
					</div>
					<div class="input-group">
						<label for="fromCurrency">Z:</label>
						<select id="fromCurrency">
							<option value="PLN">Polski Złoty (PLN)</option>
						</select>
					</div>
					<div class="input-group">
						<label for="toCurrency">Na:</label>
						<select id="toCurrency">
							<option value="PLN">Polski Złoty (PLN)</option>
						</select>
					</div>
					<button id="convertButton">Przelicz</button>
					<div id="result"></div>
				</div>
				<div class="history">
					<h2>Historia Kursów</h2>
					<div class="input-group">
						<label for="historyFromCurrency">Z:</label>
						<select id="historyFromCurrency">
							<option value="PLN">Polski Złoty (PLN)</option>
						</select>
					</div>
					<div class="input-group">
						<label for="historyToCurrency">Na:</label>
						<select id="historyToCurrency">
							<option value="PLN">Polski Złoty (PLN)</option>
						</select>
					</div>
					<div class="input-group">
						<label for="startDate">Od:</label>
						<input type="date" id="startDate">
					</div>
					<div class="input-group">
						<label for="endDate">Do:</label>
						<input type="date" id="endDate">
					</div>
					<button id="historyButton">Pokaż Historię</button>
					<div id="historyResult"></div>
					<canvas id="historyChart" width="400" height="200"></canvas>
				</div>
			</div>
			<script src="script/script.js"></script>
        </div>
        <div id="footer">
            2024&copy;Marcin Piasek, Dawid Piątek. Wszelkie prawa zastrzeżone.
        </div>
    </div>
</body>

</html>
