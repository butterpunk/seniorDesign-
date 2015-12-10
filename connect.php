<base href="/" />
<?php
session_start();

$mysql_host = Redacted;
$mysql_database = Redacted;
$mysql_user = Redacted;
$mysql_password = Redacted;

// Create connection
$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
