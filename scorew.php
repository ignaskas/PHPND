<?php

session_start();

require_once "assets/server.php";
$username = $_SESSION ['username'];
$myscore = (isset($_POST['myscore'])) ? $_POST['myscore'] : 0;

//dont bother writing users with score of 0 to database
if($myscore == 0){
    $myfile == fopen("test.txt", "a") or die("cant open shit");
    $txt = "$myscore : $username \n";
    fwrite($myfile, $txt);
    fclose($myfile);
}else{
    $sql = "INSERT INTO highscore (name, score)
        VALUES ('$username', '$myscore')";

    if ($link->query($sql) === TRUE) {
        echo "Times Up!";
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
}
$link->close();
?>
