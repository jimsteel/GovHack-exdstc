<?PHP

include_once("vba.php");

$postcode = $_GET['postcode'];
$results = get_all_in_suburb($postcode);
print json_encode($results);

?>
