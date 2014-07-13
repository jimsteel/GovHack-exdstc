<div id="search_container" class="centered" >
<div id="search_content_container" >
<span>Search 537,631 Victorian suburbs:</span>
<select id='postcodes' class= "full-width">
<?PHP

include_once("api/vba.php");


foreach (get_postcodes() as $result) {

	print "<option value='" . $result['postcode'] . "'>" . $result['suburb']  . " (" . $result['postcode'] . ")</option>";

	
}
?>
</select>
<br>
<select id="addresses" class="full-width"></select><BR>
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
				var output = "<option value = '' >Please select an address</option>";
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
