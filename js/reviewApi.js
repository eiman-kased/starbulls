
function showUserForm() {
	$('#userForm').show();
	$('#showSignUpBtn').hide();
}

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
			console.log(err)
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

function createNewReview(reviewObj, userObj = null) {
	// setting for oue getUserByEmail route
	var reviewSettings = {
		"url": "/review/new",
		"method": "POST"
	}

	reviewSettings.data = JSON.stringify(reviewObj);

	var userFName = userObj !== null ? userObj.first_name ?? '' : '';
	// check user route by email to see if the user exists
	$.ajax(reviewSettings).then(
		// successfully created new review
		function (successfulReviewResponse) {
			// if review was at least 3 out of 5
			if (reviewObj.score > 3) {
				// thank the reviewer
				alert('Thank you for your review ' + userFName);
				// otherwise
			} else {
				// apologize
				alert('Sorry for the poor experience ' + userFName ?? '' + ', we will try to do better than a ' + reviewObj.score + '/5 next time');
			}
			// log successful review with id
			console.log('review ' + successfulReviewResponse.id + ' created successfully');
		},
		// unsuccessful review submission
		function (reviewResponse) {
			// alert the user there was an issue
			alert('there was an error submitting your review: ' + reviewResponse.responseJSON.message);
			// log the specific response
			console.log(reviewResponse);
		}
	);
}

function createNewUser() {
	var userObj = {
		"first_name": $('[name="firstName"]').val(),
		"last_name": $('[name="lastName"]').val(),
		"email": $('[name="userEmail"]').val(),
		"password": $('[name="password"]').val(),
		"phone": $('[name="phone"]').val()
	};

	userSettings = {
		'url': '/user/new',
		'method': 'POST',
		'data': JSON.stringify(userObj)
	};

	return $.ajax(userSettings);
};

$(document).ready(function () {
	// get all review and display
	getAllReviews();

	// add a submit event handler on th review form
	$("#reviewForm").submit(function (e) {
		// stop submission from going to defined form action
		e.preventDefault();

		// create review object
		var reviewObj = {
			'score': $('#reviewScore').val(),
			'comment': $('#comment').val(),
		};

		// get the value of the email from the form
		var userEmail = $("#userEmail").val();
		// attempt to find the user by email
		$.when(getUserByEmail(userEmail)).then(
			// successful response because the user exists
			function (successfulUserResponse) {
				// set the user id on the review
				reviewObj.userID = successfulUserResponse.id;
				// attempt to create the review
				createNewReview(reviewObj, successfulUserResponse);
			},
			// failed user response of some type
			function (invalidUserResponse) {
				// check if user not found
				if (invalidUserResponse.status === 404) {
					// set email value to be the same as the review form
					$("#userForm #email").val($("#userEmail").val());
					// set user email field to readonly
					$("#userForm #email").attr('readonly', 'readonly');
					// set focus to first name field
					$("#userForm #firstName").focus();

					// attach submit event handler to user form
					$("#userForm").submit(function (e) {
						// prevent form from submitting to action target
						e.preventDefault();
						// attempt to create the new user
						$.when(createNewUser()).then(
							// successfully created the user
							function (successfulNewUserResponse) {
								// get the new users id
								var userID = successfulNewUserResponse.id;
								// make sure we get a valid id back
								if (userID !== undefined && userID !== false) {
									// set the review user id
									reviewObj.userID = userID
									// attempt to create the review
									createNewReview(reviewObj, successfulNewUserResponse);
								}
							},
							// failed to create the new user
							function (invalidNewUserResponse) {
								// check the status code to see if we sent bad data
								if (invalidNewUserResponse.status == 400) {
									// alert the user to the error so they can fix it
									alert('there was an error creating your account: ' + invalidNewUserResponse.responseJSON.message);
									console.log('invalid new user request:', invalidNewUserResponse.responseJSON.field);
									// TODO highlight the offending field
									$('[name="' +invalidNewUserResponse.responseJSON.field[0]+'"]').focus().addClass("is-invalid");
								}
							});
					});
					// error was not 404 there was some other issue with the find user request
				} else {
					// alert the user there was an issue
					alert('there was an issue, please try again later');
					// log the error
					console.log('error finding ' + userEmail + ': ' + invalidUserResponse.responseJSON.message);
				}
			});
	});
});
