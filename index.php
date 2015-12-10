<?php include('connect.php'); ?>

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
    <!--<link href="navbar.css" rel="stylesheet">-->
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

  <body id="home">
 
 <script typer="text/Javascript">
    $(function() {
     $("button#SubmitLatLong").click(function() { 
       console.log('in button push');
       var latDat=$("#LatForm").val();
       var longDat=$("#LongForm").val();
       $("#LatForm").val("");
       $("#LongForm").val("");
       $("#SubmitLatLong span").text("Submitted");
     $.ajax({
            type:"POST",
            url: "post.php",                  //the script to call to get data          
            data: {"latitude": latDat,"longitude": longDat},                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
            dataType: "json",                //data format      
            success: function(json)          //on recieve of reply
      {
         console.log("here");
         $("#LatForm").reset();
         $("#LongForm").reset();
      }, 
    });
     });
   });
</script>

    <div class="container">
      <?php include('navbar.php'); ?>
      <div class="col-xs-12 col-md-8 mainContainer"> 
      <?php include('headimg.php'); ?>

  <div class="missionContainer">
  <h1> OUR MISSION: </h1>      
        <p> We are developing a prototype for an autonomous sensor platform that can be interfaced with nutrient sensors to gather data to aid in studying aquatic environments. The sensor platform will be a surfboard equipped with a solar powered motor, 3G transmission system, and several sensors. It will be integrated with a website that allows for user input that can change the destination of the device, causing it to move.</p>
  
  </div>

    <span id ="Post-Instructions">
       <p id="altText"> Give us a exact Latitude and Longitude that you'd like the Surfboard to go to and We'll post the temperature in the table below when it gets there. </p>
    </span>

    <div class="row">
      <div class="col-xs-3">
      <div class="input-group input-group-lg" id="LatInput">
          <input type="text" class="form-control" id="LatForm" placeholder="Latitude" aria-describedby="basic-addon1">
      </div><!--inpput group -->
    </div> <!--/.col-lg-g -->

        <div class="col-xs-3">
            <div class="input-group input-group-lg" id="LongInput">
          <input type="text" class="form-control" id="LongForm" placeholder="Longitude" aria-describedby="basic-addon1">
      </div><!--inpput group -->
    </div> <!--/.col-lg-g -->
  <div class="col-xs-3">
      <?php
      if ($_SESSION['user'] != "" && $_SESSION['rank'] == "admin")
       {
       echo "<button  class=\"btn btn-lg\" id=\"SubmitLatLong\"><span class=\"button_text\">Go little Boat Go!</span></button>";
       }
      else
       {
       echo "Must be logged in to submit!";
       }
       ?>
  </div>

</div> <!--/row-->
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
