<?php
// start the session
session_start();

// Check if the user is not logged in, then redirect the user to login page
if (!isset($_SESSION["userid"]) || $_SESSION["userid"] !== true) {
    header("location: loginUser.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8";>
        <title>Welcome <?php echo $_SESSION["name";]; ?></title>
        <link rel=&quot;stylesheet&quot; href=&quot;https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css&quot;>
    </head>
    <body>
        <p>Bonjour</p>
    </body>