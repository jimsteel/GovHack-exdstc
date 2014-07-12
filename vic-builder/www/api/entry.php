<!DOCTYPE html>
<?PHP

include_once("vba.php");

$id = $_GET['id'];

if($stmt = $mysqli->prepare("SELECT id, Site_street, Site_suburb, Allotment_Area FROM vba WHERE id = ?")) {

	$postcode = 3223;

	$stmt->bind_param('i', $id);
	$stmt->execute();
	$stmt->bind_result($id, $street, $suburb, $allotment);

	$results = array();

	while ($stmt->fetch()) {

		global $address;
		$address = $allotment . " " . $street . " " . $suburb . " " . $postcode;
		print "<A HREF='entry.php?id=$id'>$address</A><BR>\n";

	}

}

?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Street View containers</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
var geocoder;
function initialize() {
  geocoder = new google.maps.Geocoder();

  geocoder.geocode( { 'address': '<?PHP print $address; ?>'}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      var latLng = results[0].geometry.location;
      console.log("Location latlong: " + latLng);
      
      // Get panorama by location
      var service = new google.maps.StreetViewService();
      service.getPanoramaByLocation(
          latLng, 
          50, 
          function(data, status) {
              console.log("Panorama location status: "+status);
              if(status == google.maps.StreetViewStatus.OK) {
                  var panoramaLatLng = data.location.latLng;
                  var heading = google.maps.geometry.spherical.computeHeading(panoramaLatLng, latLng);
                  var panoramaOptions = {
                      position: panoramaLatLng,
                      pov: {
                         heading: heading,
                         pitch: 0
                      },
                      zoom: 1
                  };
                  var myPano = new google.maps.StreetViewPanorama(
                      document.getElementById('map-canvas'),
                      panoramaOptions);
                  myPano.setVisible(true);
             } else {
                var panoramaOptions = {
                      position: latLng,
                      pov: {
                         heading: 0,
                         pitch: 0
                      },
                      zoom: 1
                  };
                  var myPano = new google.maps.StreetViewPanorama(
                      document.getElementById('map-canvas'),
                      panoramaOptions);
                  myPano.setVisible(true);
             }
          }
      );
       
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
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
