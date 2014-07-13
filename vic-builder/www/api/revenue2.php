<?PHP

include_once("vba.php");

$results = get_cost();
print json_encode($results);

?>
