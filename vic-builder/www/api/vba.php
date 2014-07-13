<?PHP

define("MYSQL_HOST", "localhost");
define("MYSQL_USER", "root");
define("MYSQL_PASS", "exdstc");
define("MYSQL_DB", "vba");

// Building Codes of Australia
// http://www.renewaustralia.org/diy-resources/development-and-planning-issues/building-uses-as-outlined-by-the-building-code-of-australia/
define("BUILDING_CODE_HOUSE", 1);
define("BUILDING_CODE_FLATS", 2);
define("BUILDING_CODE_HOTELS_DORMS_BACKPACKERS", 3);
define("BUILDING_CODE_CARETAKERS_FLAT", 4);
define("BUILDING_CODE_OFFICE_BUILDING", 5);
define("BUILDING_CODE_SHOP", 6);
define("BUILDING_CODE_CAR_PARK_OR_WHOLESALE", 7);
define("BUILDING_CODE_WORKSHOP_LABORATORY_FACTORY", 8);
define("BUILDING_CODE_HEALTHCARE", 9);
define("BUILDING_CODE_NON_HABITALE", 10);

global $mysqli;
$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

/**
 *  Returns all known postcodes in an array.  Each array entry is a hash with "postcode" and "suburb" indexes.
 */
function get_postcodes() {

	global $mysqli;

	if($stmt = $mysqli->prepare("SELECT DISTINCT(Site_pcode),Site_suburb FROM vba")) {

	        $stmt->execute();
	        $stmt->bind_result($postcode,$suburb);

	        $results = array();
	        while ($stmt->fetch()) {
			array_push($results, array( "postcode" => $postcode, "suburb" => $suburb ));
	        }

		return $results;

	}

	return NULL;

}

/**
 *  Gets all entries for a suburb.
 */
function get_all_in_suburb($postcode) {

	global $mysqli;

	if($stmt = $mysqli->prepare("SELECT id, Site_street, Site_suburb, Allotment_Area FROM vba WHERE Site_pcode = ? AND Allotment_Area != 0")) {

	        $stmt->bind_param('i', $postcode);
	        $stmt->execute();
	        $stmt->bind_result($id, $street, $suburb, $allotment);

	        $results = array();

	        while ($stmt->fetch()) {

	                $address = $allotment . " " . $street . " " . $suburb . " " . $postcode;
			$next = array( "address" => $address, "id" => $id);
	                array_push($results, $next);

	        }

		return $results;

	}

	return NULL;

}

/**
 *  Gets an entry.
 */
function get_entry($id) {

	global $mysqli;

	if($stmt = $mysqli->prepare("SELECT id, Site_street, Site_suburb, Allotment_Area, Site_pcode FROM vba WHERE id = ?")) {
	
	        $stmt->bind_param('i', $id);
	        $stmt->execute();
	        $stmt->bind_result($id, $street, $suburb, $allotment, $postcode);

	        $results = array();

	        while ($stmt->fetch()) {

	                $address = $allotment . " " . $street . " " . $suburb . " " . $postcode;
			return array( "id" => $id, "address" => $address );

	        }

	}

	return NULL;

}

/**
 *  Prints HTML headers
 */
function print_html_header() {
?>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<?PHP
}

/**
 * Prints an entry HTML.
 */

function print_entry_html($entry, $canvasId, $border) {
?>

<DIV CLASS="entry_dropshadow">
<DIV CLASS="entry map-canvas <?PHP print $border; ?>" ID="<?PHP print $canvasId; ?>">
<SPAN CLASS="entry_description_ribbon"></SPAN>
<SPAN CLASS="entry_description"><?PHP print $entry["address"]; ?>
</DIV>
</DIV>

    <script>
var geocoder;
function initialize() {
  geocoder = new google.maps.Geocoder();
  
  var address = "<?PHP global $entry; print $entry["address"]; ?>";
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
                      document.getElementById('<?PHP print $canvasId; ?>'),
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
                      document.getElementById('<?PHP print $canvasId; ?>'),
                      panoramaOptions);
                  myPano.setVisible(true);
             }
          }
      );
       
    } else {
      //alert('Geocode was not successful for the following reason: ' + status);
    }
  });

}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>

<?PHP } ?>
