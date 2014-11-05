<?php
function __autoload($class) {
	include_once (__DIR__ . "/../calculations/Class." . $class . ".php");
}
class turnController {
	public function endTurnAction($data) {
	}
	
	public function scoreValuesAction() {
		
		$scoreArray = [];
// 		$scoreArray["granaryResearched"] = 0;
// 		$scoreArray["potteryResearched"] = 0;
// 		$scoreArray["writingResearched"] = 0;
// 		$scoreArray["wealth"] = 0;
		
// 		$scoreArray["rampartBuilt"] = 0;
// 		$scoreArray["monumentBuilt"] = 0;
// 		$scoreArray["templeBuilt"] = 0;
// 		$scoreArray["palaceBuilt"] = 0;
// 		$scoreArray["population"] = 0;
// 		$scoreArray["unhappiness"] = 0;
		
		$score = new Score($scoreArray);
		
		return $score->getScoreArray();
		
	}
}