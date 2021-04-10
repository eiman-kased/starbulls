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
	var userID;
	// check user route by email to see if the user exists
	$.ajax(getUserSettings)
		.done(function (response) { // successful response
			console.log("success", response);
			userID = response.id;
			console.log("checking response id", userID);
			return userID;
		}).fail(function (response) { // error response
			console.log("failure", response);
			// check response code
			if (response.status == 404) {
				return false;
			}
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
			// update form to reflect reason for failure
		});
}

async function createNewUser() {
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
		'data': JSON.stringify(userObj),
		'async': false
	};

	console.log('user settings', userSettings);

	$.ajax(userSettings)
		.done(function (response) {
			alert("Thank you for the review " + response.first_name + "!!");
			console.log('response', response);
			console.log('response.id', response.id);
			return response.id;
		})
		.fail(function (response) {
			alert("broke it");
			console.log(response);
		})
};

$(document).ready(function () {
	// get all review and display
	getAllReviews();

	$("#reviewForm").submit(function (e) {
		reviewObj = {
			'score': $('#reviewScore').val(),
			'comment': $('#comment').val(),
		};

		e.preventDefault();
		// get email value
		var userID = getUserByEmail($("#userEmail").val());
		if (userID !== undefined && userID !== false) {
			reviewObj.userId = userID;
			console.log("review object:", reviewObj);
			createNewReview(reviewObj);
		} else {
			// show new user form
			$("#IndexReviewForm").hide();
			$("#IndexUserForm").show();
			$("#IndexUserForm #email").val($("#userEmail").val());

			$("#userForm").submit(function (e) {
				e.preventDefault();
				createNewUser().then(function (id) {
					console.log('id:', id)
					if (id !== undefined && id !== false) {
						reviewObj.id = id
						createNewReview(reviewObj);
					} else {
						alert('bad user id');
					}
				});
			});
		}
	});
});
