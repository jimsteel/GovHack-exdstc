<div id="search_container" class="centered" style="background-color:#D0AF60;border-radius:25px;padding:10px;box-shadow:1px 1px 2px black">
<div id="search_content_container" >
<span>Search 537,631 Victorian suburbs:</span>
<select id='postcodes' style="width:100%">
<?PHP

include_once("api/vba.php");


foreach (get_postcodes() as $result) {

	print "<option value='" . $result['postcode'] . "'>" . $result['suburb']  . " (" . $result['postcode'] . ")</option>";

	
}
?>
</select>
<br>
<select id="addresses" style="width: 100%"></select><BR>
<script>
String.prototype.capitalize = function() {
    return this.toLowerCase().replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
};
	$(document).ready(function() {
		var postcodes = $('#postcodes');
		$.each(postcodes[0].options, function(i, item) {
			item.text = item.text.capitalize();

		});
			var updateDropdown = function (data) {
				$('#addresses').empty().append(function() {
				var output = "<option value = '' >Please selected address</option>";
				$.each(JSON.parse(data), function(i, row) {
output += '<option value="api/show_entry.php?id=' + row['id'] + '">' + row['address'].capitalize() + '</option>';
				});
					return output;
				});
			};
			postcodes.change(function() {
			$.get("api/suburb.php?postcode=" + postcodes[0].value, updateDropdown); 	
		});
	
		$('#addresses').change(function() {
			if (this.value == '')
				return;
			//assumes targetContainer is predefined in user of this page
			targetContainer.location.href = this.value;

		});
		// set initial address options
		$.get("api/suburb.php?postcode=" + postcodes[0].value, updateDropdown);
	});

</script>
</div>
</div>
