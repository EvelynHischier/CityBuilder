<div id="viewMap" data-ng-show = "page == 'map'">

<div class="zone" data-ng-style="zoneOneStyle" data-ng-mouseover = "hoverZone('fertile')"  data-ng-click="showPopup('zone', 'fertile')"></div>
<div class="zone" data-ng-style="zoneTwoStyle" data-ng-mouseover = "hoverZone('mountain')" data-ng-click="showPopup('zone', 'desert')"></div>
<div class="zone" data-ng-style="zoneThreeStyle" data-ng-mouseover = "hoverZone('desert')" data-ng-click="showPopup('zone', 'mountain')"></div>

<img src = "pictures/map.png" id="map"/>

</div>