
<div id="viewMenu" data-ng-show="page=='mainMenu'">

	<!-- Launch the game -->
	<input type="button" class="mainMenu" data-ng-value="dictionnary[lang]['mainMenuLaunchButton'];"
		id="button_launch" />


	<!-- 	rules -->
	<input type="button" class="mainMenu" data-ng-value="dictionnary[lang]['mainMenuRulesButton'];" 
	id="button_rules" data-ng-click="changeView('showRules', 'Rules');" />

	<!-- game modes -->
	<!-- if admin -> display -->
	<input type="button" class="mainMenu" data-ng-value="dictionnary[lang]['mainMenuGameModesButton'];"
		id="button_modes" data-ng-click="changeView('gameModes', 'Game Mode');"
		data-ng-show="admin" />


	<!-- 		exit game		 -->
	<input type="button" class="mainMenu" data-ng-value="dictionnary[lang]['mainMenuExitButton'];"
		id="button_exit" onclick="exitGame()" />

</div>