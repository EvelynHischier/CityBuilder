<div id="viewGame" data-ng-show="page == 'gameStart'"
	onload="updatePyramid()">
	<script type="text/javascript">
			//Properties, methods and events for the pyramid chart: 
			//http://docs.amcharts.com/3/javascriptcharts/AmFunnelChart
			var scribesResearched = true;
			var chart;
			
			configChart = function() {
				chart = new AmCharts.AmFunnelChart();
				chart.rotate = true;
				chart.titleField = "title";
				chart.balloonText = "";
				chart.pullDistance = 0;
				chart.marginRight = 100;
				chart.marginLeft = 15;
				chart.labelPosition = "right";
				chart.funnelAlpha = 0.9;
				chart.valueField = "value";
				chart.startX = -500;
				//chart.labelText = "[[title]]: [[value]] ([[percents]]%)"; //debugging purposes
				chart.labelText = "[[title]]";
				chart.colors = ["#C3C3C3", "#D2F079", "#F36971", "#39B7FB", "#FADAA9", "#B962B9", "#FDFBA0"];
				/*
				Colors:
				#C3C3C3 = grey
				#D2F079 = green
				#F36971 = red
				#39B7FB = blue
				#FADAA9 = piggy orange :)
				#B962B9 = violet
				#FDFBA0 = yellow
				*/
				chart.borderAlpha = 1;
				chart.startAlpha = 0;
				chart.valueRepresents = "height";
				chart.write("chartdiv");
			};
			
        </script>
	<!--   number > hover 
      wealth-->

	<table id="tableGame">
		<tbody>
			<tr>
				<td class="overview" data-ng-bind="textGameFood"></td>
				<td class="overview"><input type="text" readonly="readonly"
					style="text-align: right" data-ng-value="numberGameFood" /></td>

				<td class="overview" data-ng-bind="textGameWealth"></td>
				<td class="number"><input type="text" readonly="readonly"
					style="text-align: right" data-ng-value="numberGameWealth" /></td>

				<td class="tech" data-ng-bind="textGameWriting"
					data-ng-click="clickTechnologie('writing')"></td>
				<td class="tech" data-ng-bind="textGameGranary"
					data-ng-click="clickTechnologie('granary')"></td>
				<td class="tech" data-ng-bind="textGamePottery"
					data-ng-click="clickTechnologie('pottery')"></td>
			</tr>
			<tr>
				<th colspan="4" class="description"
					data-ng-bind="textGameDescriptionTechnologie"></th>
				<th rowspan="2"><input class="tech_Button" type="button"
					name="writing" ng-disabled="buttonInactiveW()"
					data-ng-mouseover="hoverGame('writing')"
					data-ng-click="clickTechnologie('writing')"></th>
				<th rowspan="2"><input class="tech_Button" type="button"
					name="granary" ng-disabled="buttonInactiveG()"
					data-ng-mouseover="hoverGame('granary')"
					data-ng-click="clickTechnologie('granary')"></th>
				<th rowspan="2"><input class="tech_Button" type="button"
					name="pottery" ng-disabled="buttonInactiveP()"
					data-ng-mouseover="hoverGame('pottery')"
					data-ng-click="clickTechnologie('pottery')"></th>
			</tr>
			<tr>
				<th colspan="4" class="description"
					data-ng-bind="textGameDescriptionCitizen"></th>
			</tr>
			<tr>
<!-- 			total population -->
				<td class="citizen" id="table_population" colspan="3"
					data-ng-bind="textGameTotalPop"></td>
				<td class="number"><input type="text" id="txt_poptotal"
					readonly="readonly" style="text-align: right"
					data-ng-value="numberGameTotalPop" /></td>
				<th class="pyramid" colspan="3" rowspan="10"><div id="chartdiv"></div></th>
			</tr>
			<tr>
<!-- 			available population -->
				<td class="citizen" id="table_population" colspan="3"
					data-ng-bind="textGameAvailablePop"></td>
				<td class="number"><input type="text" id="txt_popavailable"
					readonly="readonly" style="text-align: right" /></td>
			</tr>
			<tr>
<!-- 			king -->
				<td class="citizen" id="table_king" colspan="3"
					data-ng-mouseover="hoverGame('king')" data-ng-bind="textGameKing"></td>
				<td class="number"><input type="number" id="txt1" value="0" min="0"
					onBlur="updatePyramid()" 
					data-ng-model="gameTableValues['nbrKings']"  /></td>
			</tr>
			<tr>
<!-- 			priest -->
				<td class="citizen" id="table_priest" colspan="3"
					data-ng-mouseover="hoverGame('priest')"
					data-ng-bind="textGamePriest"></td>
				<td class="number"><input type="number" id="txt2" value="0" min="0"
					onBlur="updatePyramid()"
					data-ng-model="gameTableValues['nbrPriests']" /></td>
			</tr>
			<tr>
<!-- 			craftsmen -->
				<td class="citizen" id="table_craftsment" colspan="3"
					data-ng-mouseover="hoverGame('craftsmen')"
					data-ng-bind="textGameCraft"></td>
				<td class="number"><input type="number" id="txt3" value="0" min="0"
					onBlur="updatePyramid()" 
					data-ng-model="gameTableValues['nbrCraftsmen']" /></td>
			</tr>
			<tr>
<!-- 			scribes -->
				<td class="citizen" id="table_scribes" colspan="3"
					data-ng-mouseover="hoverGame('scribes')"
					data-ng-bind="textGameScribes"></td>
				<td class="number"><input type="number" id="txt4" value="0" min="0"
					onBlur="updatePyramid()" 
					data-ng-model="gameTableValues['nbrScribes']" /></td>
			</tr>
			<tr>
<!-- 			soldiers -->
				<td class="citizen" id="table_soldiers" colspan="3"
					data-ng-mouseover="hoverGame('soldier')"
					data-ng-bind="textGameSoldiers"></td>
				<td class="number"><input type="number" id="txt5" value="0" min="0"
					onBlur="updatePyramid()"
					data-ng-model="gameTableValues['nbrSoldiers']" /></td>
			</tr>
			<tr>
<!-- 			peasants -->
				<td class="citizen" id="table_peasants" colspan="3"
					data-ng-mouseover="hoverGame('peasants')"
					data-ng-bind="textGamePeasants"></td>
				<td class="number"><input type="number" id="txt6" value="0" min="0"
					onBlur="updatePyramid()"
					data-ng-model="gameTableValues['nbrPeasants']"  /></td>
			</tr>
			<tr>
<!-- 			slaves -->
				<td class="citizen" id="table_slaves" colspan="3"
					data-ng-mouseover="hoverGame('slaves')"
					data-ng-bind="textGameSlaves"></td>
				<td class="number"><input type="number" id="txt7" value="0" min="0"
					onBlur="updatePyramid()"
					data-ng-model="gameTableValues['nbrSlaves']"  /></td>
			</tr>
			<tr>
<!-- 			caravans -->
				<td class="citizen" id="table_caravans" colspan="3"
					data-ng-mouseover="hoverGame('caravans')"
					data-ng-bind="textGameCaravans"></td>
				<td class="number"><input type="text" id="caravans" value="0"
					min="0" onBlur="updatePyramid()" readonly="readonly"
					style="text-align: right"
					data-ng-model="gameTableValues['nbrCaravans']"  /></td>
			</tr>

			<!-- 			pyramid actions  -->
			<script type="text/javascript">

				configChart();
				updatePyramid();

				function updatePyramid()
				{
					var popAvailable = document.getElementById("txt_poptotal").value;
					var sum = 0;
					var population = new Array(7);
					
					//If writing is not researched, no scribes can be assigned
					if(!scribesResearched)
						document.getElementById("txt4").setAttribute("readonly", "true");
					
					//Putting all the numbers from the text fields in an array
					for(var i = 0, j = 7; i < population.length; i++, j--) {
						population[i] = Number(document.getElementById("txt" + j).value);
						sum += population[i];
					}
					
					//Data for the pyramid chart
					var data = [
					{
						"title": "Slaves",
						"value": population[0]
					},
					{
						"title": "Peasants",
						"value": population[1]
					},
					{
						"title": "Soldiers",
						"value": population[2]
					},
					{
						"title": "Scribes",
						"value": population[3]
					},
					{
						"title": "Craftsmen",
						"value": population[4]
					},
					{
						"title": "Priests",
						"value": population[5]
					},
					{
						"title": "King",
						"value": population[6]
					}];
					
					//var numbers = "Sum: " + sum + "; ";
					for(var i = 0; i < data.length; i++) {
						
						if(data[i].value / popAvailable < 0.0625) {//less than 6.25%
							data[i].value = popAvailable*0.0625;
						}
						
						if(data[i].value / popAvailable > 0.625) {//greater than 62.5%
							data[i].value = popAvailable*0.625;
						}
					}

					//if the user assigns more people than available...
					if(sum > popAvailable) {
						document.getElementById("txt_popavailable").value = 0; //So it will not display negative numbers
						var difference = sum - popAvailable;
						document.getElementById("txt6").value -= difference;
					}
					else {
						document.getElementById("txt_popavailable").value = popAvailable - sum;
					}
					
					chart.dataProvider = data;
					chart.validateData();
				}
			</script>
		</tbody>
	</table>

</div>
