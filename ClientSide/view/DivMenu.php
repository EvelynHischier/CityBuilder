
<div id="viewMenu" data-ng-show="{{ page=='mainMenu' }}">

	<!-- Launch the game -->
	<input type="button" class="mainMenu" value="Launch the game"
		id="button_launch" onclick="launchGame()" />


	<!-- 	rules -->
	<input type="button" class="mainMenu" value="Rules" 
	id="button_rules" onclick="displayRules()" />


	<!-- game modes -->
	<!-- if admin -> display -->
	<input type="button" class="mainMenu" value="Game modes"
		id="button_modes" onclick="displayGameModes()" />
	<!-- else -> do not display -->


	<!-- 		exit game		 -->
	<input type="button" class="mainMenu" value="Exit game"
		id="button_exit" onclick="exitGame()" />

</div>