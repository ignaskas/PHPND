<?php
session_start();
?>

<!DOCTYPE html>

<html>
<head>
    <title>PHP nd Ignas jasinskas MMI-7</title>

</head>
<body>

<?php
$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="phpnamudarbas"; // Database name
$table="user_info"; // Table name

// Grab User submitted information
$email = $_POST["username"];
$pass = $_POST["password"];

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username=$_POST['username'];
$password=$_POST['password'];
//@TODO: Hash and salt the passwords before writing them to database!!!!!!!!!!!!!!!!
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

$sql="SELECT * FROM $table WHERE user_Name='$username' and
user_Pas='$password'";
$result=mysqli_query($conn, $sql);

$count=mysqli_num_rows($result);

if($count==1){

    $myname = $username;
    $_SESSION['myusername'] = $myname;
    $_SESSION['mypassword'] = "password";
    header("location: assets/game.php");
}
else {
    echo "
<p>Wrong Username or Password</p>
<form action=\"index.php\" method=\"post\">
		<table class=\"login_table\">
		<tr>
		<td>Username:</td>
		<td><input type=\"text\" name=\"username\" id=\"username\"></td>
		</tr>
		<tr>
		<td>Password:</td>
		<td><input type=\"password\" name=\"password\" id=\"password\"></td>
		</tr>
		<tr>
		<td><input type=\"submit\" value=\"Login\"></td>
		</tr>
		</table>
	</form>
";
}
?>

</body>

</html>