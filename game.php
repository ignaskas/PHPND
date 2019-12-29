<?php

session_start();

// redircet if not logedin
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>

<html>
<head>
    <!--    <link rel="stylesheet" type="text/css" href="assets/style.css">-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <style>
        <?php include 'assets/style.css'; ?>
    </style>

    <title>PHP nd Ignas jasinskas MMI-7</title>

</head>
<body>
    <?php echo $_SESSION ['username'] ?>
    <p id="result"></p>
    <div onclick="start()" class="startgamebutton" id="button-3">
        <div id="circle"></div>
        <a href="#">Start Game</a>
    </div>
    <div  class="showhighscore" id="button-3">
        <div id="circle"></div>
        <a href="#">High Score</a>
    </div>
    <div onclick="logout()" class="logout" id="button-3">
        <div id="circle"></div>
        <a href="#">LogOut</a>
    </div>
    <form style="position: absolute; left: 1000px;" action="logout.php" method="get">
        <input type="submit" value="Logout For Now">
    </form>
    <div id="showscore">
        Top 10 players!<br>
        <?php include 'assets/showscore.php' ?>
    </div>
    <div id="verg"></div>
    <div id="cento"></div>
    <div id="gamearea"></div>
    <div id="addscore" class="scorefield">0</div>
    <div id="time" class="timer">100<h3></h3></div>
    <div id="topcover" class="cover">Time Left:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Score:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

</body>

<script src="assets/script.js"></script>

</html>