var query = function(functions, callBackDone, callBackFail, callBackAlways) {

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