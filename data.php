<?php include('connect.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <base "/">
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
  
	<link rel="stylesheet" type="text/css" href="style.css" >
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
<div class="container"> 
 
<?php include('navbar.php'); ?>
<div class="col-xs-8 col-md-8 mainContainer"> 
<div class="row">
<div id="map"></div>
</div>

<div class="table-responsive"> 
<?php
echo "<table id='myTable' class='table-striped'>
  <thead>
    <tr>
      <th><h3>Date</h3></th>
      <th><h3>Actual Coordinates</h3></th>
      <th><h3>Target Coordinates</h3></th>
      <th><h3>Temperature</h3></th>
    </tr>
   </thead>
      <tbody>";

$dateOut=" ";
$clatOut=" ";
$clngOut=" ";
$dlatOut=" ";
$dlngOut=" ";
$lat=" ";
$tmpOut=" "; 
$point=0;
$latarray=array();
$lngarray=array();

$sql = "SELECT * FROM dataTable ORDER BY ID DESC";
$result = mysqli_query($conn, $sql);

/* $tableresultsJS=mysqli_fetch_array($result); */
while($tableresults=mysqli_fetch_array($result)){
	


  
    $dateOut="<td>".$tableresults['DATE']."</td>";
    $clatOut="<td>".$tableresults['cLAT'].",".$tableresults['cLNG']."</td>";
    $dlatOut="<td>".$tableresults['dLAT'].",".$tableresults['dLNG']."</td>";
    $tmpOut="<td>".$tableresults['TEMP']." &deg;C</td>";
    
    $lat=$tableresults['cLAT'];
    $lng=$tableresults['cLNG'];
    $latarray[]=$tableresults['cLAT'];
    $lngarray[]=$tableresults['cLNG'];
    
	$point=$point + 1;     
    echo "<tr>". $dateOut. $clatOut. $clngOut. $dlatOut . $dlngOut . $tmpOut." </tr>";  

  
}
 
 echo "</tbody>  

</table>";
  

mysqli_close($conn);
?>
</div>
<script>
var latObj = <?php echo json_encode($latarray);?>;
var lngObj = <?php echo json_encode($lngarray);?>;

console.log(latObj);
console.log(lngObj);
</script>
    <script type="text/javascript">

var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 30.410352, lng: -91.180431},
    zoom: 18,
    mapTypeId: google.maps.MapTypeId.SATELLITE
  });

 for(var i =0; i < latObj.length; i++){
 console.log(parseFloat(latObj[i]));
  var marker = new google.maps.Marker({
  	
    position:{lat: parseFloat(latObj[i]), lng: parseFloat(lngObj[i])} ,
    map: map,
    title: 'Hello World!'
  });
  }
     
}

    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5PIdkx0leUj4LLCnaRIbnEeEuN-BSwKE&callback=initMap">
    </script>

		<hr>
      <footer>
        <p>&copy; AANPS 2015</p>
      </footer>

</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    


  </body>
</html>
