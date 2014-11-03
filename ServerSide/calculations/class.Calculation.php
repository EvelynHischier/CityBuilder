<?php
	require_once( __DIR__ . "/../model/Class.Historic.php");
	
	/*session_start();
	
	$pdo = new PDO("mysql:host=db4free.net;
				port=3306;
				dbname=pyramidgame1",
				"groupe1",
				"8?Wzgr10");*/
	/*
	 * Social pyramid
	 * 				Array Index
	 * Kings		0
	 * Priests		1
	 * Craftsmen	6
	 * Scribes		2
	 * Soldiers		3
	 * Peasants		4
	 * Slaves		5
	 */

	/*
	 * 0.027777777777777778 = 1/36
	 * 1.111111111111111111 = 10/9
	 * Calculate the food production: "magic value" (scribes = 20)
	 * => if nbrScribes >20 then set value to 1/36
	 * => else use nbrScribes
	 * 
	 */

class Calculation {
	/*************************VARIABLES*************************/
	
	private $_arrayItems;
	private $_popTotal;
	private $_wealthTotal;
	private $_nbrClasses;
	private $_nbrClassesSum;
	private $_invasion;
	private $_potteryResearched;
	private $_granaryResearched;
	private $_writingResearched;
	private $_unhappiness;
	private $_nbrCaravans;
	private $_food;
	private $_foodProduction;
	private $_templeBuilt;
	private $_palaceBuilt;
	private $_monumentBuilt;
	private $_hist;
	
	public function __construct($arrayClient) {	
		$this->_arrayItems = array();
		
		/*$this->_arrayItems["popTotal"] = $popTotal;
		$this->_nbrClassesSum = $this->_calculateAllocatedPopulation();
		$this->_arrayItems["potteryResearch"] = 0;
		$this->_arrayItems["granaryResearch"] = 0;
		$this->_arrayItems["writingResearch"] = 0;
		$this->_arrayItems["caravans"] = $nbrCaravans;
		$this->_arrayItems["wealthTotal"] = $wealthTotal;
		$this->_arrayItems["food"] = $food; //population times 2%, for 2000 people = 40 food
		*/
		$this->_arrayItems["foodProduction"] = 0;
		$this->_arrayItems["templeBuilt"] = 0;
		$this->_arrayItems["palaceBuilt"] = 0;
		$this->_arrayItems["monumentBuilt"] = 0;
		$this->_arrayItems["unhappiness"] = false;
		$this->_arrayItems["invasion"] = false;
		
		foreach($arrayClient as $key => $value) {
			$this->_arrayItems[$key] = $value;
		}
		
		$this->_hist = new Historic();
		
		/*************************DB ACCESS*************************/
		
		$this->insertIntoDB();
		
		
		$this->invasion();
		
		//1) Unhappiness
		$this->_arrayItems["unhappiness"] = $this->calculateUnhappiness($this->_nbrClasses);
		//2) wealth
		$this->_arrayItems["wealthTotal"] += $this->calculateWealth($this->_nbrClasses, $this->_arrayItems["potteryResearch"]);
		//3) caravan
		if($this->calculateCaravan($this->_arrayItems["wealthTotal"]))
			$this->_arrayItems["caravans"]++;
		//4) building
		$this->checkBuildings($this->_arrayItems["wealthTotal"], $this->_nbrClasses);
		//5) food
		$this->_arrayItems["foodProduction"] = $this->calculateFoodProduction($this->_nbrClasses,$this->_arrayItems["unhappiness"]);
		$foodConsumption = $this->_nbrClassesSum;
		$this->_arrayItems["food"] = $this->calculateRemainingFood($this->_arrayItems["granaryResearch"], $this->_arrayItems["food"], $foodConsumption, $this->_arrayItems["foodProduction"]);
		//6) population
		$newTotalPopulation = $this->calculateNewTotalPopulation($this->_arrayItems["food"], $this->_arrayItems["popTotal"], $this->_arrayItems["foodProduction"]);
		$this->_arrayItems["popTotal"] = $newTotalPopulation;
	}
	
	public function getArray() {
		return $this->_arrayItems;
	}
	
	public function calculateAllocatedPopulation() {
		return 	$this->_arrayItems["kings"] +
				$this->_arrayItems["priests"] +
				$this->_arrayItems["craftmen"] +
				$this->_arrayItems["scribes"] +
				$this->_arrayItems["soldiers"] +
				$this->_arrayItems["peasants"] +
				$this->_arrayItems["slaves"];
	}
	
	public function insertIntoDB() {
		
		//INSERT INTO DB - Table Historic
		
		
		//Parameter order
		//$game,$turn,$kings,$priests,$scribes,$soldiers,$slaves,$peasants,$craftsmen,$population,$wealth,$food,
		//$time,$score,$pottery,$granary,$writing,$caravans,$temple,$palace,$monument
		
		//$time (elapsed time) and $score will not be used
		$this->_hist->insertHistoric(1,1,$this->_arrayItems["kings"],$this->_arrayItems["priests"],$this->_arrayItems["scribes"],
			$this->_arrayItems["soldiers"],$this->_arrayItems["slaves"],$this->_arrayItems["peasants"],$this->_arrayItems["craftmen"],
			$this->_nbrClassesSum,$this->_arrayItems["wealthTotal"],$this->_arrayItems["food"],0,0,$this->_arrayItems["potteryResearch"],
			$this->_arrayItems["granaryResearch"],$this->_arrayItems["writingResearch"],$this->_arrayItems["caravans"],$this->_arrayItems["templeBuilt"],
			$this->_arrayItems["palaceBuilt"],$this->_arrayItems["monumentBuilt"]);
	}
	
	public function getInvasion() {
		return $this->_arrayItems["invasion"];
	}
	
	public function invasion() {
		if($this->_arrayItems["soldiers"]<$this->_arrayItems["popTotal"]*0.025) //number of soldiers < 2.5%
			$this->_arrayItems["invasion"] = true;
		
		//Calculate losses
		if($this->_arrayItems["invasion"]) {
			$this->_lostPop = (int) ((3-($this->_arrayItems["soldiers"]*100)/$this->_arrayItems["popTotal"])*5)*$this->_arrayItems["popTotal"]/100;
			$this->_lostWealth = (int) ((3-($this->_arrayItems["soldiers"]*100)/$this->_arrayItems["popTotal"])*15)*$this->_arrayItems["wealthTotal"]/100;
		
			echo "<p>Population lost: " . $lostPop . "</p>";
			echo "<p>Wealth lost: " . $lostWealth . "</p>";
		
			//Apply the losses
			$this->_arrayItems["wealthTotal"] -= $this->_lostWealth;
		
			$this->_arrayItems["soldiers"] -= $this->_lostPop; //example: -13800 => 0, number of soldiers
			if($this->_arrayItems["soldiers"] < 0) {
				$this->_arrayItems["peasants"] += $this->_arrayItems["soldiers"]; //-3800, number of peasants
				$this->_arrayItems["soldiers"] = 0;
			}
		
			if($this->_arrayItems["peasants"] < 0) {
				$this->_arrayItems["slaves"] += $this->_arrayItems["peasants"]; //1200, number of slaves
				$this->_arrayItems["peasants"] = 0;
			}
		
			if($this->_arrayItems["slaves"] < 0) { //false, 1200 is greater than 0
				$this->_arrayItems["scribes"] += $this->_arrayItems["slaves"]; //number of scribes
				$this->_arrayItems["slaves"] = 0;
			}
		
			if($this->_arrayItems["scribes"] < 0) {
				$this->_arrayItems["priests"] += $this->_arrayItems["scribes"]; //number of priests
				$this->_arrayItems["scribes"] = 0;
			}
		
			if($this->_arrayItems["priests"] < 0) {
				$this->_arrayItems["kings"] += $this->_arrayItems["priests"]; //number of kings
				$this->_arrayItems["priests"] = 0;
			}
		
			if($this->_arrayItems["kings"] < 0) {
				$this->_arrayItems["kings"] = 0;
			}
		} else {
			$this->_lostPop = 0;
			$this->_lostWealth = 0;
		}
	}

	/*************************UNHAPPINESS*************************/
	
	function calculateUnhappiness($nbrClasses) {
		$unhappiness = false;
		
		if($this->_arrayItems["kings"] > 1 || $this->_arrayItems["kings"] < 1 || 
			$this->_arrayItems["priests"] <= $this->calculateAllocatedPopulation()*0.0025 ||
			$this->_arrayItems["slaves"] <= $this->calculateAllocatedPopulation()*0.02)
		{
			echo "Unhappiness = 1!";
			$unhappiness = true;
		}
		
		return $unhappiness;
	}
	
	/*************************WEALTH*************************/
	
	function calculateWealth($nbrClasses, $potteryResearched) {
		$potteryValue = 0;
		
		if($potteryResearched)
			$potteryValue = 2;
		
		$producedWealth = $this->_arrayItems["craftmen"] * (10 + $potteryValue);
		return $producedWealth;
	}
	
	/*************************CARAVAN*************************/
	
	function calculateCaravan($wealthTotal) {
		if($wealthTotal >= 550)
			return true;
	}
	
	/*************************BUILDINGS*************************/
	
	function checkBuildings($wealthTotal, $nbrClasses) {

		if($this->_arrayItems["priests"] >= 10 && $this->_arrayItems["wealthTotal"] >= 550 && $this->_arrayItems["peasants"] >= 1000) {
			echo "<p>Building temple...</p>"; //set templeBuilt to 1
			$this->_arrayItems["templeBuilt"] = 1;
		}
		
		if($this->_arrayItems["wealthTotal"] >= 850 && $this->_arrayItems["peasants"] >= 1500) {
			echo "<p>Building Palace...</p>"; //set palaceBuilt to 1
			$this->_arrayItems["palaceBuilt"] = 1;
		}
		
		if($this->_arrayItems["wealthTotal"] >= 1150 && $this->_arrayItems["peasants"] >= 1900) {
			echo "<p>Building monument...</p>"; //set monumentBuilt to 1
			$this->_arrayItems["monumentBuilt"] = 1;
		}
		
	}
	
	/*************************FOOD*************************/
	
	function calculateFoodProduction($nbrClasses,$unhappiness) {
		//100/2000 = 5%
		$unhappinessFactor = 1;
		
		$scribesFactor = ($this->_arrayItems["scribes"]/$this->calculateAllocatedPopulation())*100*(1/36); //
		if($scribesFactor > (1/36))
			$scribesFactor = 1/36;
		
		if($unhappiness)
			$unhappinessFactor = 0.75;
		
		//Needs to be rounded to inferior unit -> floor(), but [tuxradar] suggests to use 
		//typecasting, as it's faster. (Source: http://www.tuxradar.com/practicalphp/4/6/1)
		
		//Example: (peasants: 500, unhappiness = true, number of scribes: 100)
		//500*0.75*((10/9)+(1/36)) = 500*0.75*1.138888
		$foodProduction = (int) ($this->_arrayItems["peasants"]*$unhappinessFactor*((10/9)+$scribesFactor));
		
		return $foodProduction;
	}
	
	/*************************CALCULATIONS*************************/
	
	function calculateRemainingFood($granaryResearched, $food, $foodConsumption, $foodProduction) {
		$foodRemaining = 0;
		
		if($granaryResearched)
			$foodRemaining = floor($food - $foodConsumption + $foodProduction);
		else
			$foodRemaining = floor($foodProduction - $foodConsumption);
		
		return $foodRemaining;
	}
	
	function calculateNewTotalPopulation($food, $popTotal) {
		echo "<p>food: " . $food . "</p>";
		echo "<p>popTotal: " . $popTotal . "</p>";
		$newTotalPopulation = $popTotal + $food * 2; //-706
		
		if($newTotalPopulation <= 0.5*$popTotal)
			$newTotalPopulation = 0.5*$popTotal;
		
		return $newTotalPopulation;
	}
}


$arrayClient = array();
$arrayClient["popTotal"] = 1000;
$arrayClient["potteryResearch"] = 1;
$arrayClient["granaryResearch"] = 1;
$arrayClient["writingResearch"] = 1;
$arrayClient["caravans"] = 50;
$arrayClient["wealthTotal"] = 100;
$arrayClient["food"] = 500;
$arrayClient["kings"] = 1;
$arrayClient["priests"] = 10;
$arrayClient["craftmen"] = 600;
$arrayClient["scribes"] = 50;
$arrayClient["soldiers"] = 500;
$arrayClient["peasants"] = 100;
$arrayClient["slaves"] = 0;

$calculation = new Calculation($arrayClient);
$ar = $calculation->getArray();
?>

<html>
<head>
<title>Testing</title>
</head>
<body>
<h1>Serious game - Round 1</h1>
<table>
	<tr>
		<td>Invasion:</td>
		<td><?php echo $ar["invasion"]; ?></td>
	</tr>
	<tr>
		<td>Total population</td>
		<td><?php echo $ar["popTotal"]; ?></td>
	</tr>
	<tr>
		<td>Population assigned:</td>
		<td><?php echo $calculation->calculateAllocatedPopulation(); ?></td>
	</tr>
	<tr>
		<td>Remaining wealth:</td>
		<td><?php var_dump($wealthTotal); ?></td>
	</tr>
	<tr>
		<td>Soldiers:</td>
		<td><input type="number" value="<?php echo $this->_arrayItems["soldiers"]; ?>" /></td>
	</tr>
	<tr>
		<td>Peasants:</td>
		<td><input type="number" value="<?php echo $this->_arrayItems["peasants"]; ?>" /></td>
	</tr>
	<tr>
		<td>Slaves:</td>
		<td><input type="number" value="<?php echo $this->_arrayItems["slaves"]; ?>" /></td>
	</tr>
	<tr>
		<td>Craftsmen:</td>
		<td><input type="number" value="<?php echo $this->_arrayItems["craftmen"]; ?>" /></td>
	</tr>
	<tr>
		<td>Scribes:</td>
		<td><input type="number" value="<?php echo $this->_arrayItems["scribes"]; ?>" /></td>
	</tr>
	<tr>
		<td>Priests:</td>
		<td><input type="number" value="<?php echo $this->_arrayItems["priests"]; ?>" /></td>
	</tr>
	<tr>
		<td>Kings:</td>
		<td><input type="number" value="<?php echo $this->_arrayItems["kings"]; ?>" /></td>
	</tr>
	<tr>
		<td>Population lost:</td>
		<td><?php echo $lostPop; ?></td>
	</tr>
	<tr>
		<td>Remaining population:</td>
		<td><?php echo $this->calculateAllocatedPopulation(); ?></td>
	</tr>
	<tr>
		<td>Wealth lost:</td>
		<td><?php echo $lostWealth; ?></td>
	</tr>
	<tr>
		<td>Food production:</td>
		<td><?php echo $foodProduction; ?></td>
	</tr>
	<tr>
		<td>Food consumption:</td>
		<td><?php echo $foodConsumption; ?></td>
	</tr>
	<tr>
		<td>Remaining food:</td>
		<td><?php echo $food; ?></td>
	</tr>
	<tr>
		<td>New total population:</td>
		<td><?php echo $newTotalPopulation; ?></td>
	</tr>
</table>
<input type="button" value="Next round" onclick="nextRound()" />

<script type="text/javascript">
	function nextRound() {
		nextRound.count = ++nextRound.count || 2;
		document.getElementsByTagName("h1")[0].innerHTML = "Serious game - Round " + nextRound.count;
	}
</script>

</body>
</html>