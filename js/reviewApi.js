function getAllReviews() {
	var settings = {
		"url": "/reviews",
		"method": "GET",
		"timeout": 0,
	};

	$.ajax(settings)
		.done(function (response) {
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
					<p class="score">Score Rating:
						 <img src="imgs/scoreCoffeeCup${r.score}.png" class="scoreCup">
					</p>
				</div>
			</div>`);
				first = false;
			});
		})
		.fail(function (err) {
			console.error(err)
		});
}

function getUserByEmail(userEmail) {
	// setting for oue getUserByEmail route
	var getUserSettings = {
		"url": "/user/" + userEmail,
		"method": "GET"
	}

	// check user route by email to see if the user exists
	return $.ajax(getUserSettings);
}

function createNewReview(reviewObj) {
	// setting for oue getUserByEmail route
	var reviewSettings = {
		"url": "/review/new",
		"method": "POST"
	}

	reviewSettings.data = JSON.stringify(reviewObj);

	// check user route by email to see if the user exists
	$.ajax(reviewSettings)
		.done(function (response) { // successful response
			console.log('review created:', response);
			// thank user for adding a review
		}).fail(function (response) { // error response
			console.log("failure", response);
			// update form to reflect reason for failure
		});
}

function createNewUser(review = null, reviewCallback = null) {
	var userObj = {
		"first_name": $('[name="firstName"]').val(),
		"last_name": $('[name="lastName"]').val(),
		"email": $('[name="userEmail"]').val(),
		"password": $('[name="password"]').val(),
		"phone": $('[name="tel"]').val()
	};

	console.log('user object', userObj);

	userSettings = {
		'url': '/user/new',
		'method': 'POST',
		'data': JSON.stringify(userObj)
	};

	console.log('user settings', userSettings);

	$.ajax(userSettings)
		.done(function (response) {
			if (review !== null) {
				review.id = response.id;
				reviewCallback(review.id);
			}
			return response.id;
		})
		.fail(function (response) {
			// FIXME let's fail gracefully
			alert("failed to create new user: " + response.responseJSON.message);
			console.log(response);
		})
};

$(document).ready(function () {
	// get all review and display
	getAllReviews();

	$("#reviewForm").submit(function (e) {
		e.preventDefault();

		reviewObj = {
			'score': $('#reviewScore').val(),
			'comment': $('#comment').val(),
		};

		// get email value
		$.when(getUserByEmail($("#userEmail").val())).then(
			function (response) {
				// successful return because the user exists
				var userID = response.id;
				reviewObj.userID = userID;
				console.log("review object:", reviewObj);
				createNewReview(reviewObj);
				//alert- thank you
				alert('Thank you for the review ' + response.first_name);

			},
			// failed reponse of some type
			function (response) {
				// check if user not found
				if (response.status === 404) {
					$("#userForm #email").val($("#userEmail").val());
					$("#userForm").submit(function (e) {
						e.preventDefault();
						createNewUser(reviewObj, function (id) {
							if (id !== undefined && id !== false) {
								reviewObj.userID = id
								createNewReview(reviewObj);
								//alert- thank you
								alert('Thank you for the review!');

							} else {
								//TODO handle error better

								alert('bad user id');
							}
						});
					});
				} else {
					// some other error
					alert('Error: ' + response.responseJSON.message);
				}
			});
	});
});
