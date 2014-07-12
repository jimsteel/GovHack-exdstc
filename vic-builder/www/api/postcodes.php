<?PHP

include_once("vba.php");

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
