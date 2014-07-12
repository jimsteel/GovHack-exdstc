<?PHP

include_once("vba.php");

$postcode = $_GET['postcode'];

$results = get_all_in_suburb($postcode);

foreach (get_all_in_suburb($postcode) as $next) {
	$url = "show_entry.php?id=" . $next["id"];
	print "<A HREF='" . $url . "'>" . $next["address"] . "</A><BR>\n";
}

?>
