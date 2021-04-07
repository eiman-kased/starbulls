	//Review Api call

	$(document).ready(function(){
		var settings = {
			"url": "/reviews",
			"method": "GET",
			"timeout": 0,
		  };

		  $.ajax(settings)
		  .done(function (response) {
			  response.map(function(r){
				$("#apiReview").append(`
					<div data-review_id=${r.id}>
					    <p>${r.username} : </p>
						<p>${r.score}</p>
						<p>${r.comment}</p>
					</div>
				`)
			  })
			console.log(response);
		  })
		  .fail(function(err){
			  console.error(err)
		  });
		// var url = "/reviews"
		// console.log("url is " , url)
		// $("#apiReview").empty();
		// $.ajax({
		// 	url,
		// 	method: "GET"
		// }).done(
		// 	function(data){
		// 		// data.map()
		// 	}
		// )

	})
