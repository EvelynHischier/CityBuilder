<?php
	require_once( "../model/Class.Historic.php");
	
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
	
	public function __construct($popTotal, $wealthTotal, $nbrClasses, $food, $nbrCaravans) {
		$this->_popTotal = 2000;
		$this->_wealthTotal = 500; //population divided by 4
		$this->_nbrClasses = array(4,50,100,620,500,500,16); //1790
		$this->_nbrClassesSum = array_sum($this->_nbrClasses);
		$this->_invasion = false;
		$this->_potteryResearched = 0;
		$this->_granaryResearched = 0;
		$this->_writingResearched = 0;
		$this->_unhappiness = false;
		$this->_nbrCaravans = 2;
		$this->_food = 1000; //population divided by 2
		$this->_foodProduction = 0;
		$this->_templeBuilt = 0;
		$this->_palaceBuilt = 0;
		$this->_monumentBuilt = 0;
		
		$this->_hist = new Historic();
		
		insertIntoDB();
		invasion();
		
		//1) Unhappiness
		$unhappiness = calculateUnhappiness($this->_nbrClasses);
		//2) wealth
		$wealthTotal += calculateWealth($this->_nbrClasses, $this->_potteryResearched);
		//3) caravan
		if(calculateCaravan($this->_wealthTotal))
			$this->_nbrCaravans++;
		//4) building
		checkBuildings($this->_wealthTotal, $this->_nbrClasses);
		//5) food
		$foodProduction = calculateFoodProduction($this->_nbrClasses,$this->_unhappiness);
		$foodConsumption = $this->_nbrClassesSum;
		$food = calculateRemainingFood($this->_granaryResearched, $this->_food, $this->_foodConsumption, $this->_foodProduction);
		//6) population
		$newTotalPopulation = calculateNewTotalPopulation($this->_food, $this->_popTotal, $this->_foodProduction);
	}
	
	/*************************DB ACCESS*************************/
	
	//INSERT INTO DB - Table Historic
	
	
	//Parameter order
	//$game,$turn,$kings,$priests,$scribes,$soldiers,$slaves,$peasants,$craftsmen,$population,$wealth,$food,
	//$time,$score,$pottery,$granary,$writing,$caravans,$temple,$palace,$monument
	
	public function insertIntoDB() {
		$this->_hist->insertHistoric(1,1,$this->_nbrClasses[0],$this->_nbrClasses[1],$this->_nbrClasses[2],
			$this->_nbrClasses[3],$this->_nbrClasses[5],$this->_nbrClasses[4],$this->_nbrClasses[6],
			$this->_nbrClassesSum,$this->_wealthTotal,$this->_food,'00:04:04',0,$this->_potteryResearched,
			$this->_granaryResearched,$this->_writingResearched,$this->_nbrCaravans,$this->_templeBuilt,
			$this->_palaceBuilt,$this->_monumentBuilt);
	}
	
	
	public function invasion() {
		if($this->_nbrClasses[3]<$this->_popTotal*0.025) //number of soldiers < 2.5%
			$this->_invasion = true;
		
		//Calculate losses
		if($this->_invasion) {
			$this->_lostPop = (int) ((3-($this->_nbrClasses[3]*100)/$this->_popTotal)*5)*$this->_popTotal/100;
			$this->_lostWealth = (int) ((3-($this->_nbrClasses[3]*100)/$this->_popTotal)*15)*$this->_wealthTotal/100;
		
			//echo "<p>Population lost: " . $lostPop . "</p>";
			//echo "<p>Wealth lost: " . $lostWealth . "</p>";
		
			//Apply the losses
			$this->_wealthTotal -= $this->_lostWealth;
		
			$this->_nbrClasses[3] -= $this->_lostPop; //example: -13800 => 0, number of soldiers
			if($this->_nbrClasses[3] < 0) {
				$this->_nbrClasses[4] += $this->_nbrClasses[3]; //-3800, number of peasants
				$this->_nbrClasses[3] = 0;
			}
		
			if($this->_nbrClasses[4] < 0) {
				$this->_nbrClasses[5] += $this->_nbrClasses[4]; //1200, number of slaves
				$this->_nbrClasses[4] = 0;
			}
		
			if($this->_nbrClasses[5] < 0) { //false, 1200 is greater than 0
				$this->_nbrClasses[2] += $this->_nbrClasses[5]; //number of scribes
				$this->_nbrClasses[5] = 0;
			}
		
			if($this->_nbrClasses[2] < 0) {
				$this->_nbrClasses[1] += $this->_nbrClasses[2]; //number of priests
				$this->_nbrClasses[2] = 0;
			}
		
			if($this->_nbrClasses[1] < 0) {
				$this->_nbrClasses[0] += $this->_nbrClasses[1]; //number of kings
				$this->_nbrClasses[1] = 0;
			}
		
			if($this->_nbrClasses[0] < 0) {
				$this->_nbrClasses[0] = 0;
			}
		} else {
			$this->_lostPop = 0;
			$this->_lostWealth = 0;
		}
	}

	/*************************UNHAPPINESS*************************/
	
	function calculateUnhappiness($nbrClasses) {
		$unhappiness = false;
		
		if($this->_nbrClasses[0] > 1 || $this->_nbrClasses[0] < 1 || 
			$this->_nbrClasses[1] <= array_sum($this->_nbrClasses)*0.0025 ||
			$this->_nbrClasses[5] <= array_sum($this->_nbrClasses)*0.02)
		{
			//echo "Unhappiness = 1!";
			$unhappiness = true;
		}
		
		return $unhappiness;
	}
	
	/*************************WEALTH*************************/
	
	function calculateWealth($nbrClasses, $potteryResearched) {
		$potteryValue = 0;
		
		if($potteryResearched)
			$potteryValue = 2;
		
		$producedWealth = $this->_nbrClasses[6] * (10 + $potteryValue);
		return $producedWealth;
	}
	
	/*************************CARAVAN*************************/
	
	function calculateCaravan($wealthTotal) {
		if($wealthTotal >= 550)
			return true;
	}
	
	/*************************BUILDINGS*************************/
	
	function checkBuildings($wealthTotal, $nbrClasses) {

		if($this->_nbrClasses[1] >= 10 && $this->_wealthTotal >= 550 && $this->_nbrClasses[4] >= 1000) {
			//echo "<p>Building temple...</p>"; //set templeBuilt to 1
			$this->_templeBuilt = 1;
		}
		
		if($this->_wealthTotal >= 850 && $this->_nbrClasses[4] >= 1500) {
			//echo "<p>Building Palace...</p>"; //set palaceBuilt to 1
			$this->_palaceBuilt = 1;
		}
		
		if($this->_wealthTotal >= 1150 && $this->_nbrClasses[4] >= 1900) {
			//echo "<p>Building monument...</p>"; //set monumentBuilt to 1
			$this->_monumentBuilt = 1;
		}
		
	}
	
	/*************************FOOD*************************/
	
	function calculateFoodProduction($nbrClasses,$unhappiness) {
		//100/2000 = 5%
		$unhappinessFactor = 1;
		
		$scribesFactor = ($this->_nbrClasses[2]/array_sum($this->_nbrClasses))*100*(1/36); //
		if($scribesFactor > (1/36))
			$scribesFactor = 1/36;
		
		if($unhappiness)
			$unhappinessFactor = 0.75;
		
		//Needs to be rounded to inferior unit -> floor(), but [tuxradar] suggests to use 
		//typecasting, as it's faster. (Source: http://www.tuxradar.com/practicalphp/4/6/1)
		
		//Example: (peasants: 500, unhappiness = true, number of scribes: 100)
		//500*0.75*((10/9)+(1/36)) = 500*0.75*1.138888
		$foodProduction = (int) ($this->_nbrClasses[4]*$unhappinessFactor*((10/9)+$scribesFactor));
		
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
		//echo "<p>food: " . $food . "</p>";
		//echo "<p>popTotal: " . $popTotal . "</p>";
		$newTotalPopulation = $popTotal + $food * 2; //-706
		
		if($newTotalPopulation <= 0.5*$popTotal)
			$newTotalPopulation = 0.5*$popTotal;
		
		return $newTotalPopulation;
	}
}
	
?>
<!--
<html>
<head>
<title>Testing</title>
</head>
<body>
<h1>Serious game - Round 1</h1>
<table>
	<tr>
		<td>Invasion:</td>
		<td><?php //var_dump($invasion); ?></td>
	</tr>
	<tr>
		<td>Total population</td>
		<td><?php //var_dump($popTotal); ?></td>
	</tr>
	<tr>
		<td>Population assigned:</td>
		<td><?php //var_dump($this->_nbrClassesSum); ?></td>
	</tr>
	<tr>
		<td>Remaining wealth:</td>
		<td><?php //var_dump($wealthTotal); ?></td>
	</tr>
	<tr>
		<td>Soldiers:</td>
		<td><input type="number" value="<?php //echo $this->_nbrClasses[3]; ?>" /></td>
	</tr>
	<tr>
		<td>Peasants:</td>
		<td><input type="number" value="<?php //echo $this->_nbrClasses[4]; ?>" /></td>
	</tr>
	<tr>
		<td>Slaves:</td>
		<td><input type="number" value="<?php //echo $this->_nbrClasses[5]; ?>" /></td>
	</tr>
	<tr>
		<td>Craftsmen:</td>
		<td><input type="number" value="<?php //echo $this->_nbrClasses[6]; ?>" /></td>
	</tr>
	<tr>
		<td>Scribes:</td>
		<td><input type="number" value="<?php //echo $this->_nbrClasses[2]; ?>" /></td>
	</tr>
	<tr>
		<td>Priests:</td>
		<td><input type="number" value="<?php //echo $this->_nbrClasses[1]; ?>" /></td>
	</tr>
	<tr>
		<td>Kings:</td>
		<td><input type="number" value="<?php //echo $this->_nbrClasses[0]; ?>" /></td>
	</tr>
	<tr>
		<td>Population lost:</td>
		<td><?php //echo $lostPop; ?></td>
	</tr>
	<tr>
		<td>Remaining population:</td>
		<td><?php //echo array_sum($this->_nbrClasses); ?></td>
	</tr>
	<tr>
		<td>Wealth lost:</td>
		<td><?php //echo $lostWealth; ?></td>
	</tr>
	<tr>
		<td>Food production:</td>
		<td><?php //echo $foodProduction; ?></td>
	</tr>
	<tr>
		<td>Food consumption:</td>
		<td><?php //echo $foodConsumption; ?></td>
	</tr>
	<tr>
		<td>Remaining food:</td>
		<td><?php //echo $food; ?></td>
	</tr>
	<tr>
		<td>New total population:</td>
		<td><?php //echo $newTotalPopulation; ?></td>
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
 -->