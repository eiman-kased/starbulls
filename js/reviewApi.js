	//Review Api call

	$(document).ready(function(){
		var settings = {
			"url": "/reviews",
			"method": "GET",
			"timeout": 0,
		  };

		  $.ajax(settings)
		  .done(function (response) {
			  console.log(response);
			  response.map(function(r){
				$("#apiReview").append(`
					<div data-review_id=${r.id}>
					    <p>${r.user.email} : </p>
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
	})
