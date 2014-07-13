<HTML>

<HEAD>
  <TITLE>Victoria Builder</TITLE>
  <script src="js/jquery-2.1.1.min.js"></script>
  <LINK REL="stylesheet" TYPE="text/css" HREF="style.css" />
</HEAD>

<BODY>

<CENTER>

<TABLE>
<TR>
<TD HEIGHT="20" COLSPAN="2"></TD>
</TR>

<TR>

<TD WIDTH="330" ALIGN="left">
<IMG SRC="images/logo.png" WIDTH=297 HEIGHT=309>
</TD>

<TD WIDTH="400" VALIGN="top">

<P>
<H3>Easy access to Victorian building activity?</H3>
</P>

<P>
<em>
Some people trawl for it,<BR>
Some people haul for it.<BR>
There sure is a call for it.<BR>
</em>
</P>

<P>
<em>Matter of fact, you can get it <b>now<b>!</em>
</P>

<script>
var targetContainer = parent.content;
</script>
<?PHP
include_once("filter.php");
?>

<P STYLE="height: 2px;"></P>

<A TARGET="content" HREF="explore.php">EXPLORE</A> |
<!-- <A TARGET="content" HREF="api/show_postcodes.php">SEARCH</A> |-->
<A TARGET="content" HREF="stats.html">EXPENDITURE GRAPH</A> |
<A TARGET="content" HREF="api.html">API</A> |
<A TARGET="content" HREF="about.html">ABOUT</A>

</TD>

</TR>
</TABLE>

</CENTER>

</BODY>

</HTML>
