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

<CENTER>
<P>
<H2>
Top 10 building expenditures in Victoria, between 2009 and 2014.
</H2>
</P>
</CENTER>

<?PHP

/*

$entry = get_entry(1);
print_entry_html($entry, "map-canvas-1", "gold");

$entry = get_entry(30000);
print_entry_html($entry, "map-canvas-2", "red");

$entry = get_entry(8888);
print_entry_html($entry, "map-canvas-3", "white");

$entry = get_entry(45454);
print_entry_html($entry, "map-canvas-4", "green");

*/

$i = 0;
foreach (get_top_20_renovations() as $next) {

  $entry = get_entry($next["id"]);
  $uniqueId = "map-canvas-" . $i++;

  # Pick a random colour (tending towards gold/red)
  $colours = [ "gold", "gold", "red", "red", "green", "white"];
  $r = rand(0, 5);

  print_entry_html($entry, $uniqueId, $colours[$r]);

}

?>

</TD>
</TR>
</TABLE>
</CENTER>

</BODY>

</HTML>
