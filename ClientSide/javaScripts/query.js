var query = function(functions, callBackDone, callBackFail, callBackAlways) {

//			var urlMehdi = "http://127.0.0.1/CityBuilder-ServerSide/fc.php";
//			var urlEvi = "http://127.0.0.1:8080/Git/CityBuilder/ServerSide/fc.php";
//			var urlPierry = "http://127.0.0.1/Git/CityBuilder/ServerSide/fc.php"

			var url = "http://groupe1.informatiquegestion.ch/ServerSide/fc.php"; 

				
			$.ajax({
				url: url,
				type: "POST",
				data:    {
					request: {
						"functions": functions 
					}
				}
			})
			.done(function( data ){
				callBackDone(data);
			})
			.fail(function( data ){
				if(typeof callBackFail !== "undefined")
					callBackFail(data);
			})
			.always(function( data ){
				if(typeof callBackAlways !== "undefined")
					callBackAlways(data);
			});
		};