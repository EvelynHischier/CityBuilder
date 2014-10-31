<div id="popupContinue" class="divPopup"
	data-ng-show="popup=='continue'">

	<div class="popupImage" id="popupImageContinue">
		<img alt="picture" data-ng-src="pictures/{{ popupPicture }}.png"
			data-ng-show="popupPicture">
	</div>
	<div class="popupText" id="popupTextContinue"
		data-ng-bind="popupYesNo_Text"></div>
	<div class="popupButton" id="popupButtonContinue">
		<input type="button" id="popupNext" value="Continue"
			data-ng-click="popupButton('continue')">
	</div>

</div>