
<div id="gameModes" data-ng-show="page=='gameModes'" >

	<!-- Block game -->
	<input type="button" class="mainMenu" data-ng-value = "dictionnary[lang]['gameModesBlock'];"
		id="button_blockGame" data-ng-click="setMode('block');" />
		

	<!-- Placement only -->
	<input type="button" class="mainMenu" data-ng-value = "dictionnary[lang]['gameModesPlacement'];"
	id="button_rules" data-ng-click="setMode('placement_only');"  />


	<!-- 5 turn mode -->
	<input type="button" class="mainMenu" data-ng-value = "dictionnary[lang]['gameModes5turns'];"
		id="button_modes" data-ng-click="setMode('5turns');"  />


	<!-- 	Infinite	 -->
	<input type="button" class="mainMenu"
		data-ng-value = "dictionnary[lang]['gameModesInfinite'];" id="button_exit"
		data-ng-click="setMode('infinite');"  />

</div>