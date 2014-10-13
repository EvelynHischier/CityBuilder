<!DOCTYPE html>

<html>
<meta charset="UTF-8" />

<head>
	<title>Authentication</title>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js" ></script>
</head>

<body>
	<form id="form">
		<div>
			<label for="pseudo">Pseudo : </label>
			<input type="text" id="pseudo" />
		</div>
		<div>
			<label for="password">Password : </label>
			<input type="password" id="password" />
		</div>
		<div>
			<input type="submit" value="Connect" />
		</div>
	</form>
	
	
	<script type="text/javascript" >
		$("#form").submit(function( evt ) {
			evt.preventDefault();
			
			var pseudo = document.getElementById("pseudo").value;
			var password = document.getElementById("password").value;
			
			$.ajax({
				url: "http://127.0.0.1/CityBuilder/ServerSide/fc.php",
				type: "POST",
				data: {
						request: {
							authentication: {
								"pseudo": pseudo,
								"password": password
							},
							"functions": [{
									path: "login/connect",
									data: {
										"pseudo": pseudo,
										"password": password
									}
								}]
						}
					}
			})
			.done(function( data ) {
				window.location = "http://127.0.0.1/CityBuilder/";
			})
			.fail(function( data ) {
				var error = JSON.parse(data.responseText);
				alert(error[0].errorInfo);
			});
		});
	</script>
	
</body>

</html>
