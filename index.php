<?php
    session_start();
    if($_SESSION["username"] == ""){
        header("location: loginAndSignUp.php");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])){
        $_SESSION["username"] = "";
        header("location: loginAndSignUp.php");

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="icon" href="./logos/nerochatlogo.svg">

</head>

<body>
    <form class="head" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <input type="submit" value="LOG OUT" name="logout" class="logout">
        <h1 class="title">NERO CHAT</h1>
    </form>
    <div class="chat">
        <textarea id="recive" cols="70" rows="30" disabled></textarea><br>
    </div>
    <div class="send">
        <input type="text" id="send"><button id="sendbtn"> <img class="logoenter" src="./logos/enter.svg" alt="send"></button>
        <script src="./app.js"></script>
    </div>
</body>
</html>

