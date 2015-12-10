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
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
  //Get data via HTTP GET
  $temp = floatval($_GET['tmp']);
  $clat  = floatval($_GET['clat']);
  $clong = floatval($_GET['clong']);
  $dlat  = floatval($_GET['dlat']);
  $dlong = floatval($_GET['dlong']);
  $pw = $_GET['pw'];
  $date = date('Y-m-d H:i:s');
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  //Get data via HTTP POST
  $date = date('Y-m-d H:i:s');
  echo "Post. " . $_POST['msg'];
  $msg = $_POST['msg'];
  //msg comes in the form of:
  // TEMPVALUE||cLATVALUE||cLONGVALUE ||dLATVALUE ||dLONGVALUE || PW
  // Proceed only if msg is long enough
  if (strlen($msg) > 7)
  {
    $msgArray = explode("||",$msg,6);
    $temp = floatval($msgArray[0]);
    $clat = floatval($msgArray[1]);
    $clong = floatval($msgArray[2]);
    $dlat = floatval($msgArray[3]);
    $dlong = floatval($msgArray[4]);
    $pw = $msgArray[5];
   }
   
}

//If there is data
if ($temp != "" && $dlat != "" && $dlong != "")
  {
  if ($pw == "ST2015")
     {
     $sql = "INSERT INTO dataTable (DATE, cLAT, cLNG, dLAT, dLNG, TEMP) VALUES ('" . $date . "', " . $clat . ", " . $clong . ", " . $dlat . ", " . $dlong . ", " . $temp . ")";
     if (mysqli_query($conn, $sql))
       //echo $temp . ", " . $clat . ", " . $clong . ", " . $dlat . ", " . $dlong . ", " . $date;
       echo $date;
      else 
       {
         echo "Error: " . $sql . "<br>" . mysql_error($db);
       }
     }
     else
     {
      //PW incorrect
     }
  }
  else
  {
    echo "No data sent";
  }

mysqli_close($conn);


?>							
