<?PHP

include_once("vba.php");

foreach (get_postcodes() as $result) {

	$url = "show_suburb.php?postcode=" . $result['postcode'];
	print "<A HREF='" . $url . "'>" . $result['suburb'] . " (" . $result['postcode'] .")</A><BR>\n";

}
