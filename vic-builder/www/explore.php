<HTML>

<?PHP include_once("api/vba.php"); ?>

<HEAD>
  <TITLE>Victoria Builder</TITLE>
  <LINK REL="stylesheet" TYPE="text/css" HREF="style.css">
  <?PHP print_html_header(); ?>
</HEAD>

<BODY>

<CENTER>
<TABLE WIDTH="850">
<TR>
<TD>

<?PHP

$entry = get_entry(1);
print_entry_html($entry, "map-canvas-1", "gold");

$entry = get_entry(30000);
print_entry_html($entry, "map-canvas-2", "red");

$entry = get_entry(8888);
print_entry_html($entry, "map-canvas-3", "white");

$entry = get_entry(45454);
print_entry_html($entry, "map-canvas-4", "green");

?>

</TD>
</TR>
</TABLE>
</CENTER>

</BODY>

</HTML>
