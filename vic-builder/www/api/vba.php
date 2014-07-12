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

?>
