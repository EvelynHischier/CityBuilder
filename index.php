

<!-- Responsive Design:  http://getbootstrap.com/2.3.2/scaffolding.html -->
<!-- IPad simulation: http://www.yourhelpcenter.com/ipad-browser-simulation/ -->

<html>
<head>
<title>Serious game</title>

<!-- Responsive Design -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="grafic/style.css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<!--  type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js" -->
</head>

<body>

	<div id="content">

		<div id="title">
			<h1>City builders</h1>
		</div>

		<!-- ---------------     Main Div   ---------------    -->
		<div id="mainDiv">
			
			
			<?php
			// include main menu
			//include_once 'view/mainMenu.php';
			
			//include_once 'view/placementMap.php';
			
			include_once 'view/gameInterface.php';
			?>
			
		</div>


		<!-- ---------------     Div on the right  - text / image / ingame buttons   ---------------    -->
		<div id="divRight">
		<?php
		// include interface on the right
		include_once 'view/interfaceRight.php';
		?>
		

		</div>
	</div>
	<!--   <script src='js/MainMenu.js'></script> -->
</body>
</html>
