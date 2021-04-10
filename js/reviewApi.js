function getAllReviews() {
	var settings = {
		"url": "/reviews",
		"method": "GET",
		"timeout": 0,
	};

	$.ajax(settings)
		.done(function (response) {
			console.log(response);
			response.map(function (r) {
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
	$.ajax(getUserSettings)
		.done(function (response) { // successful response
			console.log("success", response);
			var userID = response.id;
			console.log("checking response id", response.id);
			var reviewObj = {
				'score': $('#reviewScore').val(),
				'comment': $('#comment').val(),
				'userID': userID
			};
			console.log(reviewObj);
			// submit to new review using this id
			createNewReview(reviewObj);

		}).fail(function (response) { // error respons
			console.log("failure", response);
			// check response code
			// if 404
			// prevent default
			// show new user form
		});
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
			// update form to reflect reson for failure
		});
}

$(document).ready(function () {
	// get all review and display
	getAllReviews();

	$("#reviewForm").submit(function (e) {
		e.preventDefault();
		// get email value
		getUserByEmail($("#userEmail").val());
	});
});

