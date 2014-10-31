<div id="viewRight" data-ng-show="pageRight">
	<div id="textImage">
		<div id="hover_image">
			<img alt="picture" data-ng-src="pictures/{{ rightPicture }}.png"
				data-ng-show="rightPicture">
		</div>

		<div id="hover_text" data-ng-bind="rightText"></div>
	</div>


	<div id="button_1">
		<input type="button" class="buttonRight" id="button_turn"
			data-ng-hide="page == 'map' " value="End of turn">
	</div>


	<div id="button_2">
		<input type="button" class="buttonRight" id="button_exit"
			value="Exit game" data-ng-click="exitGame()">
	</div>

	<!--  javascript -->
	<script src="javaScripts/DivRightActions.js" type="text/javascript"></script>

</div>