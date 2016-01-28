<?php
$address=$_POST['post_address'];

$url = "http://maps.google.com/maps/api/geocode/json?address=".$address."&sensor=false&region=India";
echo $address;
$response = file_get_contents($url);
$response = json_decode($response, true);
 
$lat = $response['results'][0]['geometry']['location']['lat'];
$lng = $response['results'][0]['geometry']['location']['lng'];
echo $lat;
echo $lng;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Place details</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
    <script>
function initialize() {
  var map = new google.maps.Map(document.getElementById('map-canvas'), {
    center: new google.maps.LatLng("<?php echo $lat; ?>","<?php echo $lng; ?>"),
    zoom: 15
  });

  var request = {
    placeId: 'ChIJN1t_tDeuEmsRUsoyG83frY4'
  };

  var infowindow = new google.maps.InfoWindow();
  var service = new google.maps.places.PlacesService(map);

  service.getDetails(request, function(place, status) {
    if (status == google.maps.places.PlacesServiceStatus.OK) {
      var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
      });
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(place.name);
        infowindow.open(map, this);
      });
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>
