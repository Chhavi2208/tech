<?php
$address=$_POST['source'];
$radius=$_POST['rad'];

$url = "http://maps.google.com/maps/api/geocode/json?address=".$address."&sensor=false&region=India";
$response = file_get_contents($url);
$response = json_decode($response, true);
 
$lat = $response['results'][0]['geometry']['location']['lat'];
$lng = $response['results'][0]['geometry']['location']['lng'];

$database="youtour";
$con= mysql_connect("localhost","root","") or die("Unable to connect");


$db = mysql_select_db($database, $con) or die("Unable to connect");
echo "connected to database";

$query ="INSERT INTO location (address, lat, lng) VALUES ('$address','$lat',' $lng')";
$result= mysql_query($query);
if($result)
	{
	   echo "Successfully updated database";
	   
	}
	else
	{
	 die('Error: '.mysql_error($con));
	}
	mysql_close($con);
	 ?>
	 <html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Circles</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
</head>
<body>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <div id="map-canvas">
	<script>
// This example creates circles on the map, representing
// populations in North America.

// First, create an object containing LatLng and population for each city.
 var lati = "<?php echo $lat; ?>";

    var longi = "<?php echo $lng; ?>";
	var radi="<?php echo $radius; ?>";
var citymap = {};
citymap['kurukshetra'] = {
  center: new google.maps.LatLng(lati, longi),
};
var cityCircle;

function initialize() {
  // Create the map.
  var mapOptions = {
    zoom: 7,
    center: new google.maps.LatLng(22.0000,78.0000),
    mapTypeId: google.maps.MapTypeId.TERRAIN
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  // Construct the circle for each value in citymap.
  // Note: We scale the area of the circle based on the population.
 for (var city in citymap) {
    var populationOptions = {
      strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#FF0000',
      fillOpacity: 0.35,
      map: map,
      center: citymap[city].center,
      radius: radi*100
    };
    // Add the circle for this city to the map.
    cityCircle = new google.maps.Circle(populationOptions);
  }
}

google.maps.event.addDomListener(window, 'load', initialize);
    </script>
 
    </div>
	
    <form action="vv.php" method="POST">
    <h3>enter the place you want to visit:</h3>
    <input type="text" name="post_address"><br>	
    <input type="submit" value="submitt">
</form>
  </body>
</html>