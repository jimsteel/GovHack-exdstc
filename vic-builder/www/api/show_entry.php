<!DOCTYPE html>
<?PHP

include_once("vba.php");

$id = $_GET['id'];

global $entry;
$entry = get_entry($id);

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
  
  var address = "<?PHP global $entry; print $entry; ?>";
  geocoder.geocode( { 'address': address}, function(results, status) {
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
                      zoom: 1,
                      linksControl: false,
                      panControl: false,
                      addressControl: false,
                      zoomControl: false
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
                      zoom: 1,
                      linksControl: false,
                      panControl: false,
                      addressControl: false,
                      zoomControl: false
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
