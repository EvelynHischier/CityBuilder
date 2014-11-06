<div id="viewScore" data-ng-show="page=='score'">

	<table id="tableScore">
		<tbody>
			<tr>
<!-- 			Technologie -->
				<td class="scoreName" id="table_score" data-ng-bind="scoreTechnologyTxt"></td>
				<td class="scoreNumber"><input type="text" id="table_technology_number" readonly="readonly" data-ng-value="scoreTechnology"></td>
				
<!-- 				some text to display -->
				<td rowspan="7" id="textEndOfGame" data-ng-bind="scoreTxt"></td>
			</tr>
			<tr>
<!-- 			Wealth -->
				<td class="scoreName" id="table_score"  data-ng-bind="scoreWealthTxt"></td>
				<td class="scoreNumber"><input type="text" id="table_wealth_number" readonly="readonly" data-ng-value="scoreWealth"></td>
			</tr>
			<tr>
<!-- 			Buildings -->
				<td class="scoreName" id="table_score" data-ng-bind="scoreBuildingsTxt"></td>
				<td class="scoreNumber"><input type="text" id="table_buildings_number" readonly="readonly" data-ng-value="scoreBuildings"></td>
			</tr>
			<tr>
<!-- 			Population -->
				<td class="scoreName" id="table_score" data-ng-bind="scorePopulationTxt"></td>
				<td class="scoreNumber"><input type="text" id="table_population_number" readonly="readonly" data-ng-value="scorePopulation"></td>
			</tr>
			<tr>
<!-- 			Happiness -->
				<td class="scoreName" id="table_score" data-ng-bind="scoreHappinessTxt"></td>
				<td class="scoreNumber"><input type="text" id="table_happyness_number" readonly="readonly" data-ng-value="scoreHappyness"></td>
			</tr>
			<tr class="scoreName"></tr>
			<tr>
<!-- 			Total -->
				<td class="scoreName" id="table_score" data-ng-bind="scoreTotalTxt"></td>
				<td class="scoreNumber"><input type="text" id="table_total_number" readonly="readonly" data-ng-value="scoreTotal"></td>
			</tr>
		</tbody>

	</table>

</div>