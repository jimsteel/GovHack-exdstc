<?PHP

include_once("vba.php");

$postcode = $_GET['postcode'];

if($stmt = $mysqli->prepare("SELECT id, Site_street, Site_suburb, Allotment_Area FROM vba WHERE Site_pcode = ? AND Allotment_Area != 0")) {

	$stmt->bind_param('i', $postcode);
	$stmt->execute();
	$stmt->bind_result($id, $street, $suburb, $allotment);

	$results = array();

	while ($stmt->fetch()) {

		$address = $allotment . " " . $street . " " . $suburb . " " . $postcode;
		print "<A HREF='entry.php?id=$id'>$address</A><BR>\n";
		//array_push($results, $address);

	}

}

//print json_encode($results);

?>

