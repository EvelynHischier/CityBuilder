
<div id="gameModes" data-ng-show="page=='showGameModes'" >

	<!-- Block game -->
	<input type="button" class="mainMenu" value="Block game"
		id="button_blockGame" data-ng-click="setMode('block');" />
		

	<!-- Placement only -->
	<input type="button" class="mainMenu" value="Placement only" id="button_rules"
	data-ng-click="setMode('placement_only');"  />


	<!-- 5 turn mode -->
	<input type="button" class="mainMenu" value="5 turns mode"
		id="button_modes" data-ng-click="setMode('5turns');"  />


	<!-- 	Infinite	 -->
	<input type="button" class="mainMenu"
		data-ng-value = "lang['gameModeInfinite'];" id="button_exit"
		data-ng-click="setMode('infinite');"  />

</div>