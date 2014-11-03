<?php
	class Score {

	private $_score; //1
	private $_arrayItems;
	
	public function __construct($arrayClient) {
		$this->_arrayItems = array();
	}
	//Technologies
	$granaryResearched = true;
	$potteryResearched = false;
	$writingResearched = true;
	
	//Wealth
	$wealth = 3000;
	
	//Buildings
	$rampartBuilt = true;
	$monumentBuilt = false;
	$templeBuilt = true;
	$palaceBuilt = false;
	
	//Population
	$population = 2000;
	
	//Unhappiness
	$unhappiness = false;
	
	/***********************Calculations***********************/
	
	//Technologies
	if($granaryResearched)
		$score += 0.5;
	if($potteryResearched)
		$score += 0.5;
	if($writingResearched)
		$score += 0.5;
	
	//Wealth
	$scoreWealth = $wealth / 500 * 0.2;
	
	if($scoreWealth >= 1)
		$score += 1;
	else if($scoreWealth <= 0)
		$score += 0;
	else
		$score += round(($scoreWealth+0.5/2)/0.5)*0.5;
	
	//Buildings
	if($rampartBuilt)
		$score += 0.125;
	if($monumentBuilt)
		$score += 0.125;
	if($templeBuilt)
		$score += 0.125;
	if($palaceBuilt)
		$score += 0.125;
	
	//Population
	$scorePop = ($population / 50) * 0.02376;

	if($scorePop >= 1.5)
		$score += 1.5;
	else
		$score += $scorePop;
	
	//Unhappiness
	if(!$unhappiness)
		$score+=0.5;
	}
	/*echo "<p>$score</p>";
	$scoreRounded = round(($score+0.5/2)/0.5)*0.5;
	if($scoreRounded > 6)
		$scoreRounded = 6;
	if($score == 1)
		$scoreRounded = 1;
	echo "<p>$scoreRounded</p>";*/
	
?>