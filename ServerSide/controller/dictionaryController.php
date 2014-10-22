<?php
function __autoload( $class ) {
	include_once( __DIR__."/../model/Class." . $class . ".php" );
}

class dictionaryController {
	
	public function initializeAction($language) {
		$lang = "";
		$known_langs = array('en','fr');
		
		$userLangs = explode(',', $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
		
		if($language != null)
			array_unshift($userLangs, $language);
		
		foreach($userLangs as $index => $choosenLang) {
			$choosenLang = substr($lang, 0, 2);
			if (in_array($choosenLang, $known_langs)) {
				$lang = $choosenLang;
				break;
			}
		}
		
		if($lang == "")
			$lang = "en";
		
		$dictionary = new Dictionary();
		$array = $dictionary->getDictionary($lang);
		
		if($dictionary->getError() == "Query failed") {
			http_response_code(401);
			return array("status" => "error", "errorInfo" => "SQL error");
		}
		
		return array("status" => "success", "data" => $array);
		
	}
	
} // end of class