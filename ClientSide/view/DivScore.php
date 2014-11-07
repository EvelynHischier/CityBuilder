<div id="viewScore" data-ng-show="page=='score'">

	<table id="tableScore">
		<tbody>
			<tr>
				<!-- 			Technologie -->
				<td class="scoreName" id="table_score"
					data-ng-bind="scoreTechnologyTxt"
					data-ng-mouseover="hoverScore('technologie')"></td>
				<td class="scoreNumber"><input type="text"
					id="table_technology_number" readonly="readonly"
					data-ng-value="scoreTechnology"
					data-ng-mouseover="hoverScore('technologie')"></td>

				<!-- 				some text to display -->
				<td rowspan="7" id="textEndOfGame">
					<div id="hover_image">
						<img alt="picture" data-ng-src="pictures/{{ scorePicture }}.png"
							data-ng-show="scorePicture">
					</div>

					<div id="hover_text" data-ng-bind="scoreText"></div>
				</td>
			</tr>
			<tr>
				<!-- 			Wealth -->
				<td class="scoreName" id="table_score" data-ng-bind="scoreWealthTxt"
					data-ng-mouseover="hoverScore('wealth')"></td>
				<td class="scoreNumber"><input type="text" id="table_wealth_number"
					readonly="readonly" data-ng-value="scoreWealth"
					data-ng-mouseover="hoverScore('wealth')"></td>
			</tr>
			<tr>
				<!-- 			Buildings -->
				<td class="scoreName" id="table_score"
					data-ng-bind="scoreBuildingsTxt"
					data-ng-mouseover="hoverScore('buildings')"></td>
				<td class="scoreNumber"><input type="text"
					id="table_buildings_number" readonly="readonly"
					data-ng-value="scoreBuildings"
					data-ng-mouseover="hoverScore('buildings')"></td>
			</tr>
			<tr>
				<!-- 			Population -->
				<td class="scoreName" id="table_score"
					data-ng-bind="scorePopulationTxt"
					data-ng-mouseover="hoverScore('population')"></td>
				<td class="scoreNumber"><input type="text"
					id="table_population_number" readonly="readonly"
					data-ng-value="scorePopulation"
					data-ng-mouseover="hoverScore('population')"></td>
			</tr>
			<tr>
				<!-- 			Happiness -->
				<td class="scoreName" id="table_score"
					data-ng-bind="scoreHappinessTxt"
					data-ng-mouseover="hoverScore('happiness')"></td>
				<td class="scoreNumber"><input type="text"
					id="table_happyness_number" readonly="readonly"
					data-ng-value="scoreHappyness"
					data-ng-mouseover="hoverScore('happiness')"></td>
			</tr>
			<tr class="scoreName"></tr>
			<tr>
				<!-- 			Total -->
				<td class="scoreName" id="table_score" data-ng-bind="scoreTotalTxt"
					data-ng-mouseover="hoverScore('total')"></td>
				<td class="scoreNumber"><input type="text" id="table_total_number"
					readonly="readonly" data-ng-value="scoreTotal"
					data-ng-mouseover="hoverScore('total')"></td>
			</tr>
		</tbody>

	</table>

</div>