<HTML>

<?PHP include_once("vba.php"); ?>

<HEAD>
  <TITLE>Victoria Builder</TITLE>
  <LINK REL="stylesheet" TYPE="text/css" HREF="../style.css">
  <?PHP print_html_header(); ?>
</HEAD>

<BODY>

<CENTER>
<TABLE WIDTH="400">
<TR>
<TD>

<?PHP

$entry = get_entry($_GET["id"]);
print_entry_html($entry, "map-canvas-1", "gold");

?>

</TD>
</TR>
</TABLE>
</CENTER>

</BODY>

</HTML>
