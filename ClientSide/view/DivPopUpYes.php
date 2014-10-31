<div id="popupYes" class="divPopup" data-ng-show="popup=='yesNo'">

	<div class="popupImage" id="popupImageYes">
		<img alt="picture" src="pictures/management5.png" data-ng-src="pictures/{{ popupPicture }}.png">
	</div>
	<div class="popupText" id="popupTextYes" data-ng-bind="popupYesNo_Text"></div>
	<div class="popupButton" id="popupButtonYesNo">
	<input type="button" id="popupYes" class="twoButtons" value="Yes" data-ng-click="popupButton('ok')"/>
	<input type="button" id="popupNo" class="twoButtons" value="No" data-ng-click="popupButton('abbort')"/>
	</div>

</div>