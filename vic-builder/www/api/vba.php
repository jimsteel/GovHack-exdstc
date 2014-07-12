<?PHP

define("MYSQL_HOST", "localhost");
define("MYSQL_USER", "root");
define("MYSQL_PASS", "exdstc");
define("MYSQL_DB", "vba");

define("BUILDING_CODE_HOUSE", 1);
define("BUILDING_CODE_FLATS", 2);
define("BUILDING_CODE_HOTELS_DORMS_BACKPACKERS", 3);
define("BUILDING_CODE_CARETAKERS_FLAT", 4);
define("BUILDING_CODE_OFFICE_BUILDING", 5);
define("BUILDING_CODE_SHOP", 6);
define("BUILDING_CODE_CAR_PARK_OR_WHOLESALE", 7);
define("BUILDING_CODE_WORKSHOP_LABORATORY_FACTORY", 8);
define("BUILDING_CODE_HEALTHCARE", 9);
define("BUILDING_CODE_NON_HABITALE", 10);

$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>
