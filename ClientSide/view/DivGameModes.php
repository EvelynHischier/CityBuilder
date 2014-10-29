
<div id="gameModes" data-ng-show="page=='gameModes'" >

	<!-- Block game -->
	<input type="button" class="mainMenu" data-ng-value = "dictionary[lang]['if_gamemodes_block'];"
		id="button_blockGame" data-ng-click="setMode('1');" />
		

	<!-- Placement only -->
	<input type="button" class="mainMenu" data-ng-value = "dictionary[lang]['if_gamemodes_placement'];"
	id="button_rules" data-ng-click="setMode('2');"  />


	<!-- 5 turn mode -->
	<input type="button" class="mainMenu" data-ng-value = "dictionary[lang]['if_gamemodes_fiveturns'];"
		id="button_modes" data-ng-click="setMode('3');"  />


	<!-- 	Infinite	 -->
	<input type="button" class="mainMenu"
		data-ng-value = "dictionary[lang]['if_gamemodes_infiniteturns'];" id="button_exit"
		data-ng-click="setMode('4');"  />

</div>