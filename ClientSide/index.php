

<!-- Responsive Design:  http://getbootstrap.com/2.3.2/scaffolding.html -->
<!-- IPad simulation: http://www.yourhelpcenter.com/ipad-browser-simulation/ -->
<!-- my Git test comment -->


<html>
<head>
<title>Serious game</title>

<!-- Responsive Design -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="grafic/style.css">

<script type="text/javascript"
	src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<!--  Import all scripts  -->

<script
	src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"
	type="text/javascript"></script>
<script type="text/javascript">
		var app = angular.module("app", []);
	</script>

</head>

<body data-ng-app="app" data-ng-controller="ViewController">

	<div id="content">

		<div id="title">
			<h1 id="titleTag"></h1>
		</div>

		<!-- ---------------     Main Div   ---------------    -->
		<div id="mainDiv">
			
			
			<?php
			include_once 'view/DivMenu.php';
			
			include_once 'view/DivMap.php';
			
			include_once 'view/DivGame.php';
			
			include_once 'view/DivRules.php'; // --> scrollbar for ipad
			
			include_once 'view/DivGameModes.php';
			
			include_once 'view/DivScore.php';
			?>
			
		</div>


		<!-- ---------------     Div on the right  - text / image / ingame buttons   ---------------    -->
		<div id="divHoverRight">
		<?php
		// include interface on the right
		include_once 'view/DivRight.php';
		?>
		
		</div>
	</div>
	<script src="javaScripts/GlobalScript.js" type="text/javascript"></script>
	<script src="javaScripts/DivRightActions.js" type="text/javascript"></script>
	<script src="javaScripts/ViewController.js" type="text/javascript"></script>
	<script src="javaScripts/GameModeButtons.js" type="text/javascript"></script>
	<script src="javaScripts/MainMenuButtons.js" type="text/javascript"></script>
	<script src="javaScripts/mapZones.js" type="text/javascript"></script>


</body>
</html>
