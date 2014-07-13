<?PHP

include_once("vba.php");

$results = get_reported_cost_of_works();
print json_encode($results);

?>
