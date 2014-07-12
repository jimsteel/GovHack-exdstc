<?PHP

define("MYSQL_HOST", "localhost");
define("MYSQL_USER", "root");
define("MYSQL_PASS", "exdstc");
define("MYSQL_DB", "vba");

$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if($stmt = $mysqli->prepare("SELECT DISTINCT(Site_pcode) FROM vba")) {

	$stmt->execute();
	$stmt->bind_result($postcode);

	$results = array();

	while ($stmt->fetch()) {
		array_push($results, $postcode);
	}

}

print json_encode($results);

?>
