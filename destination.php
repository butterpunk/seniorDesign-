<?php

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
//echo "Connected successfully";

//Get destination location

$sql = "SELECT * FROM targetLoc ORDER BY ID DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "[" . $row["LAT"]. "," . $row["LONG"]. "]";
    }
} else {
    echo "404"; //No results
}

mysqli_close($conn);


?>
