<?php
	require_once( "../model/Class.Historic.php");
	
	session_start();
	
	$pdo = new PDO("mysql:host=db4free.net;
				port=3306;
				dbname=pyramidgame1",
				"groupe1",
				"8?Wzgr10");
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


	/*************************VARIABLES*************************/
	
	$popTotal = 2000;
	$wealthTotal = 500; //population divided by 4
	$nbrClasses = array(4,50,100,620,500,500,16); //1790
	$nbrClassesSum = array_sum($nbrClasses);
	$invasion = false;
	$potteryResearched = 0;
	$granaryResearched = 0;
	$writingResearched = 0;
	$unhappiness = false;
	$nbrCaravans = 2;
	$food = 1000; //population divided by 2
	$foodProduction = 0;
	$templeBuilt = 0;
	$palaceBuilt = 0;
	$monumentBuilt = 0;
	
	/*************************DB ACCESS*************************/
	
	//INSERT INTO DB - Table Historic
	$hist = new Historic();
	
	//Parameter order
	//$game,$turn,$kings,$priests,$scribes,$soldiers,$slaves,$peasants,$craftsmen,$population,$wealth,$food,
	//$time,$score,$pottery,$granary,$writing,$caravans,$temple,$palace,$monument
	
	$hist->insertHistoric(1,1,$nbrClasses[0],$nbrClasses[1],$nbrClasses[2],$nbrClasses[3],$nbrClasses[5],$nbrClasses[4],
			$nbrClasses[6],$nbrClassesSum,$wealthTotal,$food,'00:04:04',0,$potteryResearched,$granaryResearched,
			$writingResearched,$nbrCaravans,$templeBuilt,$palaceBuilt,$monumentBuilt);
	
	
	/*************************CALCULATIONS*************************/
	echo "<p>Wealth: " . $wealthTotal . "</p>";
	echo "<p>Food: " . $food . "</p>";
	
	//Calculate invasion
	if($nbrClasses[3]<$popTotal*0.025) //number of soldiers < 2.5%
		$invasion = true;
	
	//Calculate losses
	if($invasion) {
		$lostPop = (int) ((3-($nbrClasses[3]*100)/$popTotal)*5)*$popTotal/100;
		$lostWealth = (int) ((3-($nbrClasses[3]*100)/$popTotal)*15)*$wealthTotal/100;
		
		echo "<p>Population lost: " . $lostPop . "</p>";
		echo "<p>Wealth lost: " . $lostWealth . "</p>";
		
		//Apply the losses
		$wealthTotal -= $lostWealth;

		$nbrClasses[3] -= $lostPop; //example: -13800 => 0, number of soldiers
		if($nbrClasses[3] < 0) {
			$nbrClasses[4] += $nbrClasses[3]; //-3800, number of peasants
			$nbrClasses[3] = 0;
		}
		
		if($nbrClasses[4] < 0) {
			$nbrClasses[5] += $nbrClasses[4]; //1200, number of slaves
			$nbrClasses[4] = 0;
		}
		
		if($nbrClasses[5] < 0) { //false, 1200 is greater than 0
			$nbrClasses[2] += $nbrClasses[5]; //number of scribes
			$nbrClasses[5] = 0;
		}
		
		if($nbrClasses[2] < 0) {
			$nbrClasses[1] += $nbrClasses[2]; //number of priests
			$nbrClasses[2] = 0;
		}
		
		if($nbrClasses[1] < 0) {
			$nbrClasses[0] += $nbrClasses[1]; //number of kings
			$nbrClasses[1] = 0;
		}
		
		if($nbrClasses[0] < 0) {
			$nbrClasses[0] = 0;
		}
	} else {
		$lostPop = 0;
		$lostWealth = 0;
	}
	
	//1) Unhappiness
	$unhappiness = calculateUnhappiness($nbrClasses);
	//2) wealth
	$wealthTotal += calculateWealth($nbrClasses, $potteryResearched);
	//3) caravan
	if(calculateCaravan($wealthTotal))
		$nbrCaravans++;
	//4) building
	checkBuildings($wealthTotal, $nbrClasses);
	//5) food
	$foodProduction = calculateFoodProduction($nbrClasses,$unhappiness);
	$foodConsumption = $nbrClassesSum;
	$food = calculateRemainingFood($granaryResearched, $food, $foodConsumption, $foodProduction);
	//6) population
	$newTotalPopulation = calculateNewTotalPopulation($food, $popTotal, $foodProduction);
	
	/*************************UNHAPPINESS*************************/
	
	function calculateUnhappiness($nbrClasses) {
		$unhappiness = false;
		
		if($nbrClasses[0] > 1 || $nbrClasses[0] < 1 || 
			$nbrClasses[1] <= array_sum($nbrClasses)*0.0025 ||
			$nbrClasses[5] <= array_sum($nbrClasses)*0.02)
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
		
		$producedWealth = $nbrClasses[6] * (10 + $potteryValue);
		return $producedWealth;
	}
	
	/*************************CARAVAN*************************/
	
	function calculateCaravan($wealthTotal) {
		if($wealthTotal >= 550)
			return true;
	}
	
	/*************************BUILDINGS*************************/
	
	function checkBuildings($wealthTotal, $nbrClasses) {
		if($nbrClasses[1] >= 10 && $wealthTotal >= 550 && $nbrClasses[4] >= 1000)
			echo "<p>Building temple...</p>"; //set templeBuilt to 1
		
		if($wealthTotal >= 850 && $nbrClasses[4] >= 1500)
			echo "<p>Building Palace...</p>"; //set palaceBuilt to 1
		
		if($wealthTotal >= 1150 && $nbrClasses[4] >= 1900)
			echo "<p>Building monument...</p>"; //set monumentBuilt to 1
		
	}
	
	/*************************FOOD*************************/
	
	function calculateFoodProduction($nbrClasses,$unhappiness) {
		//100/2000 = 5%
		$unhappinessFactor = 1;
		
		$scribesFactor = ($nbrClasses[2]/array_sum($nbrClasses))*100*(1/36); //
		if($scribesFactor > (1/36))
			$scribesFactor = 1/36;
		
		if($unhappiness)
			$unhappinessFactor = 0.75;
		
		//Needs to be rounded to inferior unit -> floor(), but [tuxradar] suggests to use 
		//typecasting, as it's faster. (Source: http://www.tuxradar.com/practicalphp/4/6/1)
		
		//Example: (peasants: 500, unhappiness = true, number of scribes: 100)
		//500*0.75*((10/9)+(1/36)) = 500*0.75*1.138888
		$foodProduction = (int) ($nbrClasses[4]*$unhappinessFactor*((10/9)+$scribesFactor));
		
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
		<td><?php var_dump($invasion); ?></td>
	</tr>
	<tr>
		<td>Total population</td>
		<td><?php var_dump($popTotal); ?></td>
	</tr>
	<tr>
		<td>Population assigned:</td>
		<td><?php var_dump($nbrClassesSum); ?></td>
	</tr>
	<tr>
		<td>Remaining wealth:</td>
		<td><?php var_dump($wealthTotal); ?></td>
	</tr>
	<tr>
		<td>Soldiers:</td>
		<td><input type="number" value="<?php echo $nbrClasses[3]; ?>" /></td>
	</tr>
	<tr>
		<td>Peasants:</td>
		<td><input type="number" value="<?php echo $nbrClasses[4]; ?>" /></td>
	</tr>
	<tr>
		<td>Slaves:</td>
		<td><input type="number" value="<?php echo $nbrClasses[5]; ?>" /></td>
	</tr>
	<tr>
		<td>Craftsmen:</td>
		<td><input type="number" value="<?php echo $nbrClasses[6]; ?>" /></td>
	</tr>
	<tr>
		<td>Scribes:</td>
		<td><input type="number" value="<?php echo $nbrClasses[2]; ?>" /></td>
	</tr>
	<tr>
		<td>Priests:</td>
		<td><input type="number" value="<?php echo $nbrClasses[1]; ?>" /></td>
	</tr>
	<tr>
		<td>Kings:</td>
		<td><input type="number" value="<?php echo $nbrClasses[0]; ?>" /></td>
	</tr>
	<tr>
		<td>Population lost:</td>
		<td><?php echo $lostPop; ?></td>
	</tr>
	<tr>
		<td>Remaining population:</td>
		<td><?php echo array_sum($nbrClasses); ?></td>
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