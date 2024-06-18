<?php
session_start();
require("connect.php");
?>
<!DOCTYPE html>
<html lang="PL-pl">

<head>
    <title>Kalkulator</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>

<body>
    <div id="all">
        <div id="header">
            <div id="logo">
                <a href="../index.php" class="logolink">
                   
                    <span class="logotekst1">Kalkulator Walut</span>
                </a>
            </div>
        </div>
        <div id="navigation">
            <ol>
                <li><a href="../index.php">Strona Główna</a></li>
                
                <?php
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
                {
                    echo "<li><a href="."#".">".$_SESSION['Username']."</a>
                        <ul>
                            <li><a href="?><?php
                                if($_SESSION['Username']=='admin')
                                {

                                    echo "adminpage.php";

                                }
                                else
                                {
                                    echo "userpage.php";
                                }
                            ?><?php echo">Profil</a></li>
                            <li><a href="."settings.php".">Ustawienia</a></li>
                            <li><a href="."logout.php".">Wyloguj</a></li>
                            </ul></li>";
                }
                else
                {
                    echo "<li><a href="."login.php".">Logowanie</a></li>";
                }
                ?>
            </ol>
        </div>
        <div id="content">
            <div id="user">
                <h1>
                    <?php
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                            echo "Witaj ".$_SESSION['Username'];
                        }
                        else {
                            echo "Nie powinno cię tu być, wróć tu gdy się zalogujesz";
                        }           
                    ?>
                </h1>
            </div>

            <div>

            <?php
                include("userdetails.php");
            ?>

            </div>
			<div>
				<?php
require("connect.php");

if (isset($_SESSION['ID_User'])) {
    $user_id = $_SESSION['ID_User'];
    $sql = "SELECT amount, from_currency, to_currency, result, date FROM search WHERE user_id = ? ORDER BY date DESC";
    $params = array($user_id);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "<h2>Historia przeliczania walut</h2>";
    echo "<table>";
    echo "<tr><th>Kwota</th><th>Z waluty</th><th>Na walutę</th><th>Wynik</th><th>Data</th></tr>";

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "<tr><td>{$row['amount']}</td><td>{$row['from_currency']}</td><td>{$row['to_currency']}</td><td>{$row['result']}</td><td>{$row['date']->format('Y-m-d H:i:s')}</td></tr>";
    }

    echo "</table>";

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    echo "Musisz być zalogowany, aby zobaczyć historię przeliczeń.";
}
?>
			</div>

        </div>
        <div id="footer">
            2022&copy;Marcin Piasek, Dawid Piątek. Wszelkie prawa zastrzeżone.
        </div>
    </div>
</body>

</html>
