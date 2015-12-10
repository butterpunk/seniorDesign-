<!-- <div class=row> -->
<div class="col-xs-4 col-md-4">
<div class="row">
  <img class="img-responsive" src="/AASP_1.png"></img>
</div>  
  <div class="row" id="homenav"> 
   <a class="sidebar" href="/">HOME</a>
  </div>
  <div class="row" id="datanav">
   <a class="sidebar" href="/data/">DATA COLLECTED</a>
  </div>
  <div class="row" id="photonav">
   <a class="sidebar" href="/photos/">PROGRESS PHOTOS</a>
  </div>
  <div class="row" id="devnav">
   <a  class="sidebar" href="/dev/">DEVELOPERS</a>
  </div>
  <?php
  echo "<div class=\"row\" id=\"loginnav\">";
  if ($_SESSION['rank'] != "" && $_SESSION['user'] != "")
   {
   echo "<a class=\"sidebar\" href=\"logout/\">LOGOUT</a>";
   }
  else
   {
   echo "<a class=\"sidebar\" href=\"login/\">LOGIN</a>";
   } 
  echo "</div>";
  ?>
</div>
