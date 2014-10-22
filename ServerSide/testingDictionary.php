<?php
require_once( __DIR__."/model/Class.Dictionary.php");

session_start();

// prepare MySQL connection
$pdo = new PDO("mysql:host=db4free.net;
				port=3306;
				dbname=pyramidgame1",
				"groupe1",
				"8?Wzgr10");

$dict = new Dictionary();

$item_test = $dict->getDictionary("popup_pottery","en");

?>

<html>
<head>
<meta charset="utf-8" />
<title>Testing DB</title>
</head>
<body>
<?php 
	foreach($item_test as $key => $value) {	
		echo "<br />";
		print_r($value);
	}
?>
</body>
</html>