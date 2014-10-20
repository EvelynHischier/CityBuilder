<?php
require_once( __DIR__."/model/Class.Dictionary.php");

session_start();

$dict = new Dictionary();

$item_test = $dict->getDictionary("popup_pottery","en");

?>

<html>
<head>
<title>Testing DB</title>
</head>
<body>
<?php 
	echo "<p>Language: ".$item_test[1]."</p>"; //en
	echo "<p>Key: ".$item_test[0]."</p>"; //popup_pottery
	echo "<p>Text: ".$item_test[2]."</p>"; //Corresponding text
?>
</body>
</html>