<HTML>

<?PHP include_once("api/vba.php"); ?>

<HEAD>
  <TITLE>Victoria Builder</TITLE>
  <LINK REL="stylesheet" TYPE="text/css" HREF="style.css">
  <?PHP print_html_header(); ?>
</HEAD>

<BODY>

<?PHP 

$entry = get_entry(1);
print_entry_html($entry, "map-canvas-1", "white_border");

$entry = get_entry(30000);
print_entry_html($entry, "map-canvas-2", "red_border");

$entry = get_entry(8888);
print_entry_html($entry, "map-canvas-3", "white_border");

$entry = get_entry(454545);
print_entry_html($entry, "map-canvas-4", "green_border");

?>

</TABLE>
</CENTER>

</BODY>

</HTML>
