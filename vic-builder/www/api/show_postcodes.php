<?PHP

include_once("vba.php");

if($stmt = $mysqli->prepare("SELECT DISTINCT(Site_pcode),Site_suburb FROM vba")) {

	$stmt->execute();
	$stmt->bind_result($postcode,$suburb);

	$results = array();
	while ($stmt->fetch()) {

		print "<A HREF='suburb.php?postcode=$postcode'>$suburb ($postcode)</A><BR>\n";

	}

}

?>
