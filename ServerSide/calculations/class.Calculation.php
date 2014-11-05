<?php
	require_once( __DIR__ . "/../model/Class.Historic.php");

class Calculation {

	private $_arrayItems;
	
	public function __construct($arrayClient) {
		$this->_arrayItems = $arrayClient;
	
		$this->_arrayItems["unhappiness"] = $this->unhappiness();
		$this->_arrayItems["Wealth"] = $this->_arrayItems["Wealth"] + $this->wealthProduction();
		$this->_arrayItems["nbrCaravans"] = $this->_arrayItems["nbrCaravans"] + $this->caravanProduction();
		$this->_arrayItems["RampartBuilt"] = 1;
		$this->_arrayItems["TempleBuilt"] = 1;
		$this->_arrayItems["Food"] = $this->foodRemaining();
		
		$initialPopulation = $this->_arrayItems["Population"];
		$this->_arrayItems["Population"] = $this->calculatePopulation();

		$this->_arrayItems["nbrPriests"]	= $this->newNumber($this->_arrayItems["nbrPriests"], $initialPopulation);
		$this->_arrayItems["nbrSlaves"]		= $this->newNumber($this->_arrayItems["nbrSlaves"], $initialPopulation);
		$this->_arrayItems["nbrKings"]		= $this->newNumber($this->_arrayItems["nbrKings"], $initialPopulation);
		$this->_arrayItems["nbrScribes"]	= $this->newNumber($this->_arrayItems["nbrScribes"], $initialPopulation);
		$this->_arrayItems["nbrPeasants"]	= $this->newNumber($this->_arrayItems["nbrPeasants"], $initialPopulation);
		$this->_arrayItems["nbrSoldiers"]	= $this->newNumber($this->_arrayItems["nbrSoldiers"], $initialPopulation);
		$this->_arrayItems["nbrCraftsmen"]	= $this->newNumber($this->_arrayItems["nbrCraftsmen"], $initialPopulation);
	}
	
	public function getResult() {
		return $this->_arrayItems;
	}
	
	public function saveIntoDB() {
		$h = new Historic();
		return $h->insertHistoric($this->_arrayItems);
	}
	
	private function invasion() {
		$lostPop = (int) ((3-($this->_arrayItems["nbrSoldiers"]*100)/$this->_arrayItems["Population"])*5)*$this->_arrayItems["Population"]/100;
		$lostWealth = (int) ((3-($this->_arrayItems["nbrSoldiers"]*100)/$this->_arrayItems["Population"])*15)*$this->_arrayItems["Wealth"]/100;
	}
	
	private function newNumber($initial, $initialPopulation) {
		return (int) ( ( $initial / $initialPopulation ) * $this->_arrayItems["Population"] );
	}
	
	private function calculatePopulation() {
		$newTotalPopulation = $this->_arrayItems["Population"] + $this->_arrayItems["Food"] * 2; //-706
		
		if($newTotalPopulation <= 0.5*$this->_arrayItems["Population"])
			return 0.5*$this->_arrayItems["Population"];
		
		return $newTotalPopulation;
	}
	
	private function foodRemaining() {
		$foodProduced = $this->foodProduction();
		
		if( $this->_arrayItems["GranaryResearched"] == 1 )
			return floor($this->_arrayItems["Food"] - $foodConsumption + $foodProduced);
		else
			return floor($foodProduced - $this->calculateFoodConsumption());
	}
	
	private function calculateFoodConsumption() {
		return 	$this->_arrayItems["nbrPeasants"] +
				$this->_arrayItems["nbrKings"] +
				$this->_arrayItems["nbrSoldiers"] +
				$this->_arrayItems["nbrPriests"] +
				$this->_arrayItems["nbrScribes"] +
				$this->_arrayItems["nbrSlaves"] +
				$this->_arrayItems["nbrCraftsmen"];
	}
	
	// calculate food production (not total food)
	private function foodProduction() {
		$scribesFactor = ($this->_arrayItems["nbrScribes"]/$this->_arrayItems["Population"])*100*(1/36);
		if($scribesFactor > (1/36))
			$scribesFactor = 1/36;
		
		$unhappinessFactor = 1;
		if($this->_arrayItems["unhappiness"] == 1)
			$unhappinessFactor = 0.75;
		
		return floor( $this->_arrayItems["nbrPeasants"]*$unhappinessFactor*((10/9)+$scribesFactor) );
	}
	
	// calculate whether buildings are built
	private function templeBuilt() {
		if(
			$this->_arrayItems["TempleBuilt"] == 1
			|| (
				$this->_arrayItems["nbrPriests"] >= 10
				&& $this->_arrayItems["Wealth"] >= 550
				&& $this->_arrayItems["nbrPeasants"] >= 1000
			)
		)
			return 1;
		
		return 0;
	}
	
	private function palaceBuilt() {
		if(
			$this->_arrayItems["PalaceBuilt"] == 1
			|| (
				$this->_arrayItems["Wealth"] >= 850
				&& $this->_arrayItems["nbrPeasants"] >= 1500
			)
		)
			return 1;
		
		return 0;		
	}
	
	private function monumentBuilt() {
		if(
			$this->_arrayItems["MonumentBuilt"] == 1
			|| (
				$this->_arrayItems["wealthTotal"] >= 1150
				&& $this->_arrayItems["peasants"] >= 1900
			)
		)
			return 1;
		
		return 0;		
	}
	
	// calculates whether the population is happy or not
	private function unhappiness() {
		if( $this->_arrayItems["nbrKings"] > 1 || $this->_arrayItems["nbrKings"] < 1 || 
		$this->_arrayItems["nbrPriests"] <= $this->calculateFoodConsumption()*0.0025 ||
		$this->_arrayItems["nbrSlaves"] <= $this->calculateFoodConsumption()*0.02 )
			$unhappiness = 1;
		
		return 0;
	}
	
	// calculate the wealth production (not the total wealth)
	private function wealthProduction() {
		$potteryValue = 0;
		
		if( $this->_arrayItems["PotteryResearched"] > 0 )
			$potteryValue = 2;
		
		return $this->_arrayItems["nbrCraftsmen"] * (10 + $potteryValue);
	}
	
	// calculate caravan production (not total nbr of caravans)
	private function caravanProduction() {
		if($this->_arrayItems["Wealth"] >= 550)
			return 1;
		
		return 0;
	}
	
}