<?php
if (!isset($_SESSION['myusername']) || empty($_SESSION['myusername'])) {
    header( "Location: http://localhost/PHPND" );
    exit();
}

$username = $_SESSION['myusername'];
//echo ($username);
echo $_SESSION['myusername'];


$servername = "localhost";
$username_db = "root";
$password = "";
$dbname = "phpnamudarbas";
$myscore = (isset($_POST['myscore'])) ? $_POST['myscore'] : 0;


//conect to sql
$conn = new mysqli($servername, $username_db, $password, $dbname);
//return error if failed to connect to sql
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// if score = 0 dont bother writing that shit in to the database
if($myscore == 0){
    $myfile = fopen("test.txt", "a") or die("Unable to open file!");
    $txt = "$myscore : $username \n";
    fwrite($myfile, $txt);
    fclose($myfile);
// write the name and the score of the player in to the database
}else {
    $sql = "INSERT INTO highscore (name, score)
VALUES ('$username','$myscore')";

    if ($conn->query($sql) === TRUE) {
        echo "HighScores: <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
//print out top 5 scores from the database table
    $sql = "SELECT * FROM highscore ORDER BY score DESC limit 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo $row ["name"]. " - score: " . $row["score"]. " " . "<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
//    $conn->close();
}