
<div id="viewMenu" data-ng-show="page=='mainMenu'">

	<!-- Launch the game -->
	<input type="button" class="mainMenu" value="Launch the game"
		id="button_launch" onclick="launchGame()" />


	<!-- 	rules -->
	<input type="button" class="mainMenu" value="Rules" 
	id="button_rules" data-ng-click="changeView('showRules', 'Rules');" />


	<!-- game modes -->
	<!-- if admin -> display -->
	<input type="button" class="mainMenu" value="Game modes"
		id="button_modes" data-ng-click="changeView('showGameModes', 'Game Mode');"
		data-ng-show="admin" />


	<!-- 		exit game		 -->
	<input type="button" class="mainMenu" value="Exit game"
		id="button_exit" onclick="exitGame()" />

</div>