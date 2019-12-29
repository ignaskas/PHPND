<?php
require_once "assets/server.php";

//print out top 5 scores with usernames! and go write the fucking report
$sql = "SELECT * FROM highscore ORDER BY score DESC limit 10";
$result = $link->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo $row["name"]. " - score: " . $row["score"]. " " . "<br>";
    }
} else{
    echo "0 results";
}
$link->close();