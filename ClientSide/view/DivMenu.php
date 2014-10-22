
<div id="viewMenu" data-ng-show="page=='mainMenu'">

	<!-- Launch the game -->
	<input type="button" class="mainMenu" data-ng-value="dictionary[lang]['if_main_launch'];"
		data-ng-click="launchGame()" id="button_launch" />


	<!-- 	rules -->
	<input type="button" class="mainMenu" data-ng-value="dictionary[lang]['if_main_rules'];" 
	id="button_rules" data-ng-click="changeView('showRules', 'Rules');" />

	<!-- game modes -->
	<!-- if admin -> display -->
	<input type="button" class="mainMenu" data-ng-value="dictionary[lang]['if_main_game'];"
		id="button_modes" data-ng-click="changeView('gameModes', 'Game Mode');"
		data-ng-show="admin" />


	<!-- 		exit game		 -->
	<input type="button" class="mainMenu" data-ng-value="dictionary[lang]['mainMenuExitButton'];"
		id="button_exit" onclick="exitGame()" />

</div>