
<div id="gameModes" data-ng-show="{{ page=='gameModes' }}" >

	<!-- Block game -->
	<input type="button" class="mainMenu" value="Block game"
		id="button_blockGame" onclick="blockGame()" />


	<!-- Placement only -->
	<input type="button" class="mainMenu" value="Placement only" id="button_rules"
		onclick="placementOnly()" />


	<!-- 5 turn mode -->

	<input type="button" class="mainMenu" value="5 turns mode"
		id="button_modes" onclick="fiveTurns()" />


	<!-- 	Infinite	 -->
	<input type="button" class="mainMenu" value="Infinite turns mode"
		id="button_exit" onclick="InfiniteTurns()" />


	<!--  script for clicks on buttons -->
	<script src="javaScripts/GameModeButtons.js" type="text/javascript"></script>

</div>