<?php
require_once( __DIR__."/model/Class.Dictionary.php");
require_once( __DIR__."/model/Class.Zone.php");
require_once( __DIR__."/model/Class.ItemType.php");
require_once( __DIR__."/model/Class.Item.php");
require_once( __DIR__."/model/Class.Game.php");
require_once( __DIR__."/model/Class.Mode.php");
require_once( __DIR__."/model/Class.ChosenMode.php");

session_start();

// prepare MySQL connection
$pdo = new PDO("mysql:host=db4free.net;
				port=3306;
				dbname=pyramidgame1",
				"groupe1",
				"8?Wzgr10");

$dict = new Dictionary();

$item_test = $dict->getDictionary("en");

$now = new DateTime();

$zone = new Zone();

$zone_test=$zone->getZone("Desert"); //FertileLand, Desert or Mountain

//**********************************//

$it = new ItemType();

$itemTypes = $it->getItemTypes();

$item = new Item();

$items = $item->getItems();

$game = new Game();

$games = $game->getGames();

$mode=new Mode();

$modes=$mode->getModes();

$chosenMode = new ChosenMode();

$chosenModes = $chosenMode->getChosenModes();
?>

<html>
<head>
<meta charset="utf-8" />
<title>Testing DB</title>
</head>
<body>
<?php 

	echo "<h1>Current time: ".$now->format('Y-m-d H:i:s')."</h1>";
	echo "<h1>Current timestamp: ".$now->getTimestamp()."</h1>";
	
	/*foreach($item_test as $key => $value) {	
		echo "<br />";
		print_r($value);
	}*/
	//var_dump($item_test);
	//var_dump($zone_test);
	//var_dump($itemTypes);
	//var_dump($items);
	//var_dump($games);
	//var_dump($modes);
	var_dump($chosenModes);
	function searchForIndex($search,$array) {
		foreach ($array as $key => $val) {
			if ($val['Key'] === $search) {
				return $key;
			}
		}
		return null;
	}
	
	$idx = searchForIndex("score_total",$item_test);
	echo "<br />".$item_test[$idx]['Text'];
	
?>
</body>
</html>
