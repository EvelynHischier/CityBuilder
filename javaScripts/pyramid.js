/**
 * Functions of the pyramid
 * 
 */

function configChart(chart) {
	chart = new AmCharts.AmFunnelChart();
	chart.rotate = true;
	chart.titleField = "title";
	chart.balloon.fixedPosition = true;
	chart.marginRight = 210;
	chart.marginLeft = 15;
	chart.labelPosition = "right";
	chart.funnelAlpha = 0.9;
	chart.valueField = "value";
	chart.startX = -500;
	chart.colors = ["#C3C3C3", "#D2F079", "#F36971", "#39B7FB", "#FADAA9", "#B962B9", "#FDFBB5"];
	/*
			Colors:
			#C3C3C3 = grey
			#D2F079 = green
			#F36971 = red
			#39B7FB = blue
			#FADAA9 = piggy orange :)
			#B962B9 = violet
			#FDFBB5 = yellow
	 */
	chart.borderAlpha = 1;
	chart.startAlpha = 0;
	chart.valueRepresents = "area";
	chart.write("chartdiv");
}

function updatePyramid(chart)
{
	var data = [
	{
		"title": "Slaves",
		"value": document.getElementById("table_slaves_number").value
	},
	{
		"title": "Peasants",
		"value": document.getElementById("table_peasants_number").value
	},
	{
		"title": "Soldiers",
		"value": document.getElementById("table_soldiers_number").value
	},
	{
		"title": "Scribes",
		"value": document.getElementById("table_scribes_number").value
	},
	{
		"title": "Craftsmen",
		"value": document.getElementById("table_craftsment_number").value
	},
	{
		"title": "Priests",
		"value": document.getElementById("table_priest_number").value
	},
	{
		"title": "King",
		"value": document.getElementById("table_king_number").value
	}
	];
	
	chart.dataProvider = data;
	chart.validateData();
}