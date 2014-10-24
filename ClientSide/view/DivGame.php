<div id="viewGame" data-ng-show = "page == 'gameStart'" onload="updatePyramid()">
        <script type="text/javascript">
			//Properties, methods and events: http://docs.amcharts.com/3/javascriptcharts/AmFunnelChart
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
// 				chart.labelText = "[[title]]: [[value]] ([[percents]]%)";
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
			
			if(AmCharts.isReady) {
				configChart();
			} else {
				AmCharts.ready(configChart);
			}
			
        </script>


	<table id="tableGame">
		<tbody>
			<tr>
				<td>Score (title)</td>
				<td>Score</td>
				<td class="tech">Writing</td>
				<td class="tech">Granary</td>
				<td class="tech">Pottery</td>
			</tr>
			<tr>
				<th colspan="2" class="description">Choose technology</th>
				<th rowspan="2"><input class="tech_Button" type="button" name="writing"></th>
				<th rowspan="2"><input class="tech_Button" type="button" name="granary"></th>
				<th rowspan="2"><input class="tech_Button" type="button" name="pottery"></th>
			</tr>
			<tr>
				<th colspan="2" class="description">Assign citizen</th>
			</tr>
			<tr>
				<td class="citizen" id="table_population">Total pop</td>
				<td class="number">number</td>
				<th class="pyramid" colspan="3" rowspan="10" ><div id="chartdiv"></div></th>
			</tr>
			<tr>
				<td class="citizen" id="table_population">Aviable pop</td>
				<td class="number"><input type="number" id="txt_popavailable" value="1200" readonly /></td>
			</tr>
			<tr>
				<td class="citizen" id="table_king">king</td>
				<td class="number"><input type="number" id="txt1" value="1" min="0" onBlur="updatePyramid()"/></td>
			</tr>
			<tr>
				<td class="citizen" id="table_priest">priest</td>
				<td class="number"><input type="number" id="txt2" value="1" min="0" onBlur="updatePyramid()"/></td>
			</tr>
			<tr>
				<td class="citizen" id="table_craftsment">Craftsmen</td>
				<td class="number"><input type="number" id="txt3" value="1" min="0" onBlur="updatePyramid()"/></td>
			</tr>
			<tr>
				<td class="citizen" id="table_scribes">Scribes</td>
				<td class="number"><input type="number" id="txt4" value="1" min="0" onBlur="updatePyramid()"/></td>
			</tr>
			<tr>
				<td class="citizen" id="table_soldiers">Soldiers</td>
				<td class="number"><input type="number" id="txt5" value="1" min="0" onBlur="updatePyramid()"/></td>
			</tr>
			<tr>
				<td class="citizen" id="table_peasants">Peasants</td>
				<td class="number"><input type="number" id="txt6" value="1" min="0" onBlur="updatePyramid()"/></td>
			</tr>
			<tr>
				<td class="citizen" id="table_slaves">Slaves</td>
				<td class="number"><input type="number" id="txt7" value="1" min="0" onBlur="updatePyramid()"/></td>
			</tr>
			<tr>
				<td class="citizen" id="table_caravans">Caravans</td>
				<td class="number"><input type="number" id="caravans" value="1" min="0" onBlur="updatePyramid()"/></td>
			</tr>

			
<!-- 			pyramid actions  -->
			<script type="text/javascript">
				var popAvailable = 1200;
				function updatePyramid()
				{
					var sum = 0;
					var scribesResearched = true;
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

					for(var i = 0; i < data.length; i++) {
						
						if(data[i].value / sum < 0.0625) {//less than 6.25%
							data[i].value = popAvailable*0.0625;
						}
						
						if(data[i].value / sum > 0.625) {//greater than 62.5%
							data[i].value = popAvailable*0.625;
						}
					}
					
					if(sum > popAvailable) {
						alert("You cannot assign more people than available!");
						document.getElementById("txt_popavailable").value = 0;
					}
					else
						document.getElementById("txt_popavailable").value = popAvailable - sum;
					
					chart.dataProvider = data;
					chart.validateData();
				}
			</script>
		</tbody>
	</table>

</div>
