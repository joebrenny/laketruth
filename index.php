<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lake Truth</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <?php require 'parts/navbar.php'; ?>

<div class="jumbotron text-center">
  <img src="img/sunsetdockimage.jpg" width="675" />
  <h1>Lake Truth</h1>
  <p>Review lake conditions driven by users like <strong>You!!!</strong></p>
</div>
<!--this is were i have my link to the map google-->
<div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=minnesota&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3>Fishing Lakes </h3>
      <p>Find were other people have had good luck </p>
      <img src="img/fishing.jfif">
      <p>track lakes and comments </p>
    </div>
    <div class="col-sm-4">
      <h3>Pleasure Boats</h3>
      <p>Time to Chill and Cruise</p>
      <img src="img/ponton.jpg" height="175" width=80%>
      <p>Find lakes that are great for Pleasure Boats</p>
    </div>
    <div class="col-sm-4">
      <h3>Go Fast Boats</h3>
      <p>Find great Place to go FAST!!!! </p>
      <img src="img/gofast.jpg" height="175" width=80%>
      <p>Some Lakes may have speed limits </p>
    </div>
  </div>
</div>

</body>
</html>
