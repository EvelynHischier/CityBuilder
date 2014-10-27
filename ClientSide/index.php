

<!-- Responsive Design:  http://getbootstrap.com/2.3.2/scaffolding.html -->
<!-- IPad simulation: http://www.yourhelpcenter.com/ipad-browser-simulation/ -->
<!-- my Git test comment -->


<html>
<head>
<title>Serious game</title>


<link rel="stylesheet" type="text/css" href="grafic/style.css">

<script type="text/javascript"
	src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<!--  Import all scripts  -->

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js" type="text/javascript"></script>

<script src="javaScripts/mapZone.js" type="text/javascript"></script>
<script src="javaScripts/amcharts.js" type="text/javascript"></script>
<script src="javaScripts/funnel.js" type="text/javascript"></script>

<script src="javaScripts/query.js" type="text/javascript" ></script>
<script src="javaScripts/mapLanguage.js" type="text/javascript" ></script>
<script src="javaScripts/app.js" type="text/javascript" ></script>

</head>

<body data-ng-app="app" data-ng-controller="ViewController">

	<div id="content">

		<div id="title">
			<h1 id="titleTag" data-ng-bind="title"></h1>
		</div>
		
				<?php
				include_once 'view/DivPopUpYes.php';
				
				include_once 'view/DivPopUpContinue.php';
				?>

		<!-- ---------------     Main Div   ---------------    -->
		<div id="mainDiv">
			
			<?php
			include_once 'view/DivMenu.php';
			
			include_once 'view/DivMap.php';
			
			include_once 'view/DivGame.php';
			
			include_once 'view/DivRules.php';
			
			include_once 'view/DivGameModes.php';
			
			include_once 'view/DivScore.php';
			
			include_once 'view/DivLogin.php';
			
			include_once 'view/DivRegister.php';
			?>
			
		</div>


		<!-- ---------------     Div on the right  - text / image / ingame buttons   ---------------    -->
		<div id="divHoverRight">
		<?php
		// include interface on the right
		include_once 'view/DivRight.php';
		include_once 'view/DivRulesButton.php';
		?>
		
		</div>
	</div>


</body>
</html>
