<?PHP

include_once("vba.php");

$postcodes = get_postcodes();
print json_encode($postcodes);

?>
