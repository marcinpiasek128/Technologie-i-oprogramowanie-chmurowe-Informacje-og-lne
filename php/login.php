<?php
require_once("login-script.php");
?>
<!DOCTYPE html>
<html lang="PL-pl">

<head>
    <title>Kalkulator</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/login.css" />
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
            <form method="post">
                <div id="div_login">
                    <h1>Logowanie</h1>
                    <div>
                        <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Nazwa użytkownika" />
                    </div>
                    <div>
                        <input type="password" class="textbox" id="txt_pwd" name="txt_pwd" placeholder="Hasło" />
                    </div>
                    <div>
                        <input type="submit" value="Zaloguj" name="but_submit" id="but_submit" />
                    </div>
                    <div>
                        <a href="../php/signup.php" class="sign">Załóż konto</a>
                    </div>
                    <div>

                        <?php
                            if(isset($_SESSION['e_txt_uname']))
                            {
                                echo '<div class="error">'.$_SESSION['e_txt_uname'].'</div>';
                                unset($_SESSION['e_txt_uname']);
                            }
                        ?>
                        <?php
                            if(isset($_SESSION['e_txt_pwd']))
                            {
                                echo '<div class="error">'.$_SESSION['e_txt_pwd'].'</div>';
                                unset($_SESSION['e_txt_pwd']);
                            }
                        ?>
                        <?php
                            if(isset($_SESSION['e_txt_ban']))
                            {
                                echo '<div class="error">'.$_SESSION['e_txt_ban'].'</div>';
                                unset($_SESSION['e_txt_ban']);
                            }
                        ?>

                    </div>
                </div>
            </form>
        </div>
        <div id="footer">
            2024&copy;Marcin Piasek, Dawid Piątek. Wszelkie prawa zastrzeżone.
        </div>
    </div>
</body>

</html>
