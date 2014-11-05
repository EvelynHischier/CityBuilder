<?php
	class Score {

		private $_score; //1
		private $_scoreArray;
		
		private $_granaryResearched;
		private $_potteryResearched;
		private $_writingResearched;
		private $_wealth;
		private $_rampartBuilt;
		private $_monumentBuilt;
		private $_templeBuilt;
		private $_palaceBuilt;
		private $_population;
		private $_unhappiness;
		
		public function __construct($arrayClient) {
			$this->_scoreArray = array (
					"techs" => 0,
					"wealth" => 0,
					"buildings" => 0,
					"population" => 0,
					"unhappiness" => 0,
					"total" => 1
			);
			$this->_granaryResearched = $arrayClient["granaryResearched"];
			$this->_potteryResearched = $arrayClient["potteryResearched"];
			$this->_writingResearched = $arrayClient["writingResearched"];
			$this->_wealth = $arrayClient["wealth"];
			$this->_rampartBuilt = $arrayClient["rampartBuilt"];
			$this->_monumentBuilt = $arrayClient["monumentBuilt"];
			$this->_templeBuilt = $arrayClient["templeBuilt"];
			$this->_palaceBuilt = $arrayClient["palaceBuilt"];
			$this->_population = $arrayClient["population"];
			$this->_unhappiness = $arrayClient["unhappiness"];
			
			calculateScore();
			
			$this->_scoreArray["total"] += $this->_scoreArray["techs"];
			$this->_scoreArray["total"] += $this->_scoreArray["wealth"];
			$this->_scoreArray["total"] += $this->_scoreArray["buildings"];
			$this->_scoreArray["total"] += $this->_scoreArray["population"];
			$this->_scoreArray["total"] += $this->_scoreArray["unhappiness"];
		}
		
		public function getScoreArray() {
			return $this->_scoreArray;
		}
		//Technologies
		/*$granaryResearched = true;
		$potteryResearched = false;
		$writingResearched = true;*/
		
		//Wealth
		//$wealth = 3000;
		
		//Buildings
		/*$rampartBuilt = true;
		$monumentBuilt = false;
		$templeBuilt = true;
		$palaceBuilt = false;
		*/
		//Population
		/*$population = 2000;
		*/
		//Unhappiness
		/*$unhappiness = false;
		*/
		/***********************Calculations***********************/
		function calculateScore() {
			//Technologies
			$technologiesScore = 0;
			if ($this->_granaryResearched)
				$technologiesScore += 0.5;
			if ($this->_potteryResearched)
				$technologiesScore += 0.5;
			if ($this->_writingResearched)
				$technologiesScore += 0.5;
			
			$this->_scoreArray["techs"] = $technologiesScore;
			
				
			// Wealth
			$scoreWealth = $this->_wealth / 500 * 0.2;
			
			if ($scoreWealth >= 1)
				$this->_scoreArray["wealth"] += 1;
			else if ($scoreWealth <= 0)
				$this->_scoreArray["wealth"] += 0;
			else
				$this->_scoreArray["wealth"] += round ( ($scoreWealth + 0.5 / 2) / 0.5 ) * 0.5;
				
			// Buildings
			$buildingsScore = 0;
			if ($this->_rampartBuilt)
				$buildingsScore += 0.125;
			if ($this->_monumentBuilt)
				$buildingsScore += 0.125;
			if ($this->_templeBuilt)
				$buildingsScore += 0.125;
			if ($this->_palaceBuilt)
				$buildingsScore += 0.125;
			$this->_scoreArray["buildings"] = $buildingsScore;
				
			// Population
			$scorePop = ($this->_population / 50) * 0.02376;
			
			if ($scorePop >= 1.5)
				$this->_scoreArray["population"] += 1.5;
			else
				$this->_scoreArray["population"] += $scorePop;
				
			// Unhappiness
			if (!$this->_unhappiness)
				$this->_scoreArray["unhappiness"] += 0.5;
		}
	}
	/*echo "<p>$score</p>";
	$scoreRounded = round(($score+0.5/2)/0.5)*0.5;
	if($scoreRounded > 6)
		$scoreRounded = 6;
	if($score == 1)
		$scoreRounded = 1;
	echo "<p>$scoreRounded</p>";*/
	
?>