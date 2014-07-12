<?PHP

include_once("vba.php");

$id = $_GET['id'];
print json_encode(get_entry($id));

?>
