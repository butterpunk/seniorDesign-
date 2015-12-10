<?php

include('connect.php');

$loggedIn = false;
$un = $_POST["username"];
$pw = $_POST["password"];
//Hash the pw
$pw = md5($pw);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>AANSP</title> 
	
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css?version=2" >
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


  </head>

  <body id="login">

    <div class="container">
      <?php include('navbar.php'); ?>
      <div class="col-xs-12 col-md-8 mainContainer"> 
      <?php include('headimg.php'); ?>

    <span id ="Post-Instructions">
       <p id="altText">
<?php
//Update session data after a login.
if ($un != "" && $pw != "")
  {
  $sql = "SELECT * FROM users WHERE USERNAME='".$un."' AND PWORD='".$pw."' LIMIT 1";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) 
   {
   // output data of each row
   while($row = mysqli_fetch_assoc($result)) 
     {
     $loggedIn = true;
     $_SESSION['user'] = $row["USERNAME"];
     $_SESSION['rank'] = $row["RANK"];
     }
    } else {
      echo "Login unsuccessful.";} //No results
  }


if ($loggedIn == true || ($_SESSION['rank'] != "" && $_SESSION['user'] != ""))
  {
     echo "You are logged in.<br />";
     echo "Welcome, " . $_SESSION['user'] . "<br />";
     echo "Rank: " . $_SESSION['rank'];
  } 
else
 {
  echo '<form action="login.php" method="post"><input type="hidden" name="accountDetails" value="log"> '; 
  echo 'Username: <input type="text" name="username" class="form-control" aria-describedby="basic-addon1"/><br />'; 
  echo 'Password: <input type="password" name="password" class="form-control" aria-describedby="basic-addon1"/><br />'; 
  echo '<input type="submit" value="Login" />'; 
  echo '</form>'; 
  }

?>
       </p>
    </span>

    <!--/row-->
</div>
   


<hr>
      <footer>
        <p>&copy; AANPS 2015</p>
      </footer>


 </div> 



   <!-- /container -->

    



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
			
