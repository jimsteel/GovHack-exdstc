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

		$address = $allotment . " " . $street . " " . $suburb . " " . $postcode;
		print "<A HREF='entry.php?id=$id'>$address</A><BR>\n";

	}

}

?>
