<?php

require_once "config.php";
require_once "session.php";


$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // validate if email is empty
    if (empty($email)) {
        $error .= '<p class="error">Please enter email.</p>';
    }

    // validate if password is empty
    if (empty($password)) {
        $error .= '<p class="error">Please enter your password.</p>';
    }

    if (empty($error)) {
        if($query = $db->prepare("SELECT * FROM registerlogin WHERE email = ?")) {
            $query->bind_param('s', $email);
            $query->execute();
            $row = $query->fetch();
            if ($row) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION["userid"] = $row['userId'];
                    $_SESSION["user"] = $row;

                    // Redirect the user to welcome page
                    header("location: welcome.php");
                    exit;
                } else {
                    $error .= '<p class=&quot;error&quot;>The password is not valid.</p>';
                }
            } else {
                $error .= '<p class="error">No User exist with that email address.</p>';
            }
        }
        $query->close();
    }
    // Close connection
    mysqli_close($db);
}
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="C:\Users\victo\Documents\ChironGroup\AccueilPage\loginUser1.css"/>
    </head>
    <header>
        <div class="header-left">
            <img class="logo" src='./chironGroup.png'/>
            <p class="connexion">Chiron Group</p>
        </div>
        <div class="recherche">
            <input class="input" type='text'/>
        </div>
            <div class="header-right">
                <img class="french-flag" alt="flag" src='https://upload.wikimedia.org/wikipedia/commons/c/c3/Flag_of_France.svg'/>
                <img alt="profile" src="./user.png"/>
                <img class="burger-menu" alt="menu" src="./burgerMenu.png"/>
            </div>        
    </header>
    <body class="body-inscription">
       <div class="inscription-box">
        <p id="inscription-entreprise">Connexion</p>
        <form action="" method="post"> 
            <div class="inscription-form">
                <div class="inscription-box-element">
                    <label>Adresse Mail</label>
                    <input class="inscription-input"  name='name' type='text'/>
                </div>
                <div class="inscription-box-element">
                    <label>Mot de Passe</label>
                    <input class="inscription-input" name="surname" type="text" />
                </div>
                <input class='inscription-user2' name='submit' type="submit" value="Confirmer"/>
            </div>
        </form>
        
       </div>
    </body>
    <footer>
        <div class="footer">
            <div class="information-legal">
                <p class="information-legal-element" id="information-legal">Informations légales</p>
                <p class="information-legal-element">Données personnelles</p>
                <p class="information-legal-element">Mentions Légales</p>
            </div>
            <div class="a-propos">
                <p class="a-propos-element" id="a-propos">A propos</p>
                <p class="a-propos-element">CGU</p>
                <p class="a-propos-element">FAQ</p>
            </div>
            <div class="clients">
                <p class="clients-element" id="clients">Clients</p>
                <p class="clients-element">Entreprises</p>
                <p class="clients-element">Particuliers</p>
            </div>
        </div>
    </footer>