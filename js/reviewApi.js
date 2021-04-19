//Review Api call

$(document).ready(function () {
	var settings = {
		"url": window.location + "reviews",
		"method": "GET",
		"timeout": 0,
	};

	$.ajax(settings)
		.done(function (response) {
			console.log(response);
			$("#reviews-carousel").empty();
			var first = true;
			response.map(function (r) {
				var active = (first ? 'active' : '');
				$("#reviews-carousel").append(
					`<div class="carousel-item review-item ${active}">
				<div data-review_id="${r.id}" class="customerReview">
					<img src="imgs/starbulls_icon.png" alt="starbulls icon" id="reviewIcon">
					<div id="userInfo">
						<p id="email" class="reviewEmail">${r.user.email}</p>
					</div>
					<blockquote>
						<p class="comment">
						${r.comment}
						</p>
					</blockquote>
					<p class="score">Score Rating: ${r.score}
						 <img src="imgs/scoreCoffeeCup4.png" class="scoreCup">
					</p>
				</div>
			</div>`);
				first = false;
			});
			console.log(response);
		})
		.fail(function (err) {
			console.error(err)
		});
})
