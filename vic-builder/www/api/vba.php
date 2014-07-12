<?PHP

define("MYSQL_HOST", "localhost");
define("MYSQL_USER", "root");
define("MYSQL_PASS", "exdstc");
define("MYSQL_DB", "vba");

$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

echo $mysqli->host_info . "\n";

?>
