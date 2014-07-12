<!DOCTYPE html>
<?PHP

include_once("vba.php");

$id = $_GET['id'];

global $entry;
$entry = get_entry($id);
print_entry_html($entry);

?>
