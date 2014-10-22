/**
 *  used in placementMap.php
 *  creates buttons on map
 */
function initializeMap() {
	var map;
	var zoneOne;
	var zoneTwo;
	var zoneThird;

	init();


	function init(){

		map = $("#viewMap");

		divContent = $('#content');


		unitLeft = map.width()/100;
		unitTop = map.height()/100;

		zoneOne = document.createElement("div");
		zoneTwo = document.createElement("div");
		zoneThird = document.createElement("div");

		setButtonZone1();
		setButtonZone2();
		setButtonZone3();
	}
	function getPXTop(number){
		divTitle = $('#title');
		zeroPoint = divTitle.height()+27;

		return zeroPoint + unitTop * number;
	}
	function getPXLeft(number){
		zeroPoint = 23;

		return zeroPoint + unitLeft * number;
	}
	function getRndPoint(max, min) {
		return Math.floor((Math.random() *( max - min)) + min);
	}
	function setButtonDiagonal(top, maxTop, maxLeft){

		procent = top/ maxTop;
		return maxLeft * procent;
	}


//	fertile land
	function setButtonZone1(){
		var left ;
		var top;
		var rndLeft;
		var rndTop;

		var rndZone;

		var minLeft = [getPXLeft( 15),	getPXLeft(34)];
		var minTop  = [getPXTop(12),	getPXTop(17)];

		var maxLeft = [getPXLeft(43),	getPXLeft(35)];
		var maxTop =  [getPXTop(17),	getPXTop(47)];

		rndZone = Math.floor((Math.random() * 2));

		left = getRndPoint(maxLeft[rndZone], minLeft[rndZone]);
		top =  getRndPoint(maxTop[rndZone], minTop[rndZone]); 


		drawButton(left, top, zoneOne); 
	}

//	desert
	function setButtonZone2(){					/// ____________________________________________________
		var left ;
		var top;

		var rndZone;

		var minLeft= [getPXLeft(1), 	getPXLeft(25), 	getPXLeft(59)];
		var minTop = [getPXTop(25), 	getPXTop(63), 	getPXTop(13)];

		var maxLeft = [getPXLeft(22), 	getPXLeft(55), 	getPXLeft(55)];
		var maxTop =  [getPXTop(90), 	getPXTop(90), 	getPXTop(63)];  

		rndZone = Math.floor((Math.random() * 2));

		left =  getRndPoint(maxLeft[rndZone], minLeft[rndZone]);  // minLeft[2]; //
		top =   getRndPoint(maxTop[rndZone], minTop[rndZone]); // minTop[2]; //

		drawButton(left, top, zoneTwo);
	}

//	mountains
	function setButtonZone3(){
		var left ;
		var top;
		var bottom;
		var leftExclude;
		var rndZone = 1;
		var procent;

		var minLeft= [getPXLeft(70), 	getPXLeft(58), 	getPXLeft(92)];
		var minTop = [getPXTop(30) , 	getPXTop(35),	getPXTop(0)];

		var maxLeft = [getPXLeft(84), 	getPXLeft(94),		getPXLeft(93)];
		var maxTop =  [getPXTop(36), 	getPXTop(62),		getPXTop(28)];

		// ipad size
		if (map.width() < 700)
			maxLeft[1] = getPXLeft(91);

		rndZone = Math.floor((Math.random() * 3));


		// exclude a triangle -> Suezkanal
		if (rndZone == 0){

			left = getRndPoint(maxLeft[rndZone], minLeft[rndZone]);
			top =  getRndPoint(maxTop[rndZone], minTop[rndZone]); 

			bottom = (maxTop[rndZone] - minTop[rndZone])/4 + minTop[rndZone];
			leftExclude = (maxLeft[rndZone] - minLeft[rndZone]) /4*3 + minLeft[rndZone];

			if (left < leftExclude){
				if (top > bottom){
					left = leftExclude;
					top = bottom;
				}
			}
		}
		if (rndZone == 1){
			top =  getRndPoint(maxTop[rndZone], minTop[rndZone]); 

			left = setButtonDiagonal(top, maxTop[rndZone], maxLeft[rndZone]);
		}
		if (rndZone == 2){
			left = getRndPoint(maxLeft[rndZone], minLeft[rndZone]);
			top =  getRndPoint(maxTop[rndZone], minTop[rndZone]); 
		}

		drawButton(left, top, zoneThird);
	}

	function drawButton(left, top, zone){
		$(zone).addClass("zone")
		.css("width", 50+"px")
		.css("height", 50+"px")
		.css("border", "solid white " + 5 + "px")
		.css("position", "absolute")
		.attr("title", "zone one")
		.css("left", left+"px")
		.css("top", top+"px")
		.on("click", function(evt) {
			alert("Hello");
		})
		.mouseover(function(evt) {
			alert("hover ");
		});

		map.prepend(zone);
	}
};


