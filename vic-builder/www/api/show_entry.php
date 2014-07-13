<!DOCTYPE html>
<HTML>

<?PHP include_once("vba.php"); ?>

<HEAD>
  <LINK REL="stylesheet" TYPE="text/css" HREF="../style.css">
  <?PHP print_html_header(); ?>
</HEAD>

<BODY>

<DIV CLASS="content">

<?PHP

$id = $_GET['id'];
$entry = get_entry($id);
print_entry_html($entry, "map-canvas-1", "gold_border");

?>

</DIV>

</BODY>

</HTML>
