<?php

// display errors so we know if there is a problem
// ini_set('display_errors', 1);

// call session_start so we can utilize the $_SESSION super global
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
// we need the User and Review classes
require_once 'src/User.php';
require_once 'src/Review.php';

// initialize empty variables
$firstName = '';
$lastName = '';
$tel = '';
$email = '';
$password = '';

// set an empty error array
$error = array();

if (isset($_SESSION['review_post']) && !(isset($_POST['userSubmit']))) {
	// if redirected an alert message will prompt user to signup
	echo '<script language="javascript">';
	echo 'alert("Please complete signup to save your review!")';
	echo '</script>';
}

// check to see if $_SESSION contains a review in case we were redirected
if (isset($_SESSION['review_post'])) {
	// set the review.form data as $_POST review
	$_POST['review'] = json_decode($_SESSION['review_post'], true);

	// presets the userEmail from the review form
	$_POST['userEmail'] = $_POST['review']['userEmail'] ?? '';

}

// check to see if the submit button was clicked on the user form
if (isset($_POST['userSubmit'])) {

	// check to make sure firstName is not empty
	if (!empty(trim($_POST['firstName']))) {
		// set firstName to the user firstName sans whitespace
		$firstName = trim($_POST['firstName']);
	} else {
		// if it is empty, add error message to array to be displayed later
		$error['firstName'] = 'First Name is Required';
	}

	// check to make sure lastName is not empty
	if (!empty(trim($_POST['lastName']))) {
		// set lastName to user lastName sans whitespace
		$lastName = trim($_POST['lastName']);
	} else {
		// if it is empty, add error message to array to be displayed later
		$error['lastName'] = 'Last Name is Required';
	}

	// check to make sure tel is not empty
	if (!empty(trim($_POST['tel']))) {
		// set tel to user tel sans whitespace
		$tel = trim($_POST['tel']);
	} else {
		//if it is empty, add error message to array to be displayed later
		$error['tel'] = 'Phone Number is Required';
	}

	// check to make sure userEmail is not empty
	if (!empty(trim($_POST['userEmail']))) {
		// set userEmail to user userEmail sans whitespace
		$email = trim($_POST['userEmail']);
	} else {
		// if it is empty, add error message to array to be displayed later
		$error['email'] = 'An Email Address is Required';
	}

	// check to make sure password is not empty
	if (!empty(trim($_POST['password']))) {
		// set password to user password sans whitespace
		$password = trim($_POST['password']);
	} else {
		// if it is empty, add error message to array to be displayed later
		$error['password'] = 'Enter your Password';
	}

	// creating a new user object
	$user = new User($firstName, $lastName, $email, $password, $tel, false);

	// save user to the database which will return false if unsuccessful
	$userSaved = $user->saveToDB();
	// var_dump($userSaved);

	// checks if $userSaved is successful
	if ($userSaved) {
		// TODO determine if we are going to display a message
		echo 'User Saved';
		// echo 'confirmation email sent to ' . $user->getEmail();

	} else {
		// displays error message if user cannot be saved
		echo 'Error saving user!';
	}

	// checks to see if review form has been submitted previously
	if (isset($_SESSION['review_submit'])) {
		// sets $reviewJSON to an associative array of review data
		$reviewJSON = json_decode($_SESSION['review_submit'], true);


		// creates a new review object from the reviewJSON
		$review = new Review($reviewJSON['score'], $reviewJSON['comment'], $userSaved->getId());

		// saves $review object to database
		if ($review->saveToDB()) {
			// checks if review is not associated with a user ie:anonymous review
			if (!$review->getUserID()) {
				echo '<script language="javascript">';
				echo 'alert("Review saved anonymously")';
				echo '</script>';
			} else {
				// if review is associated with a user, display this message thanking them for their review
				echo '<script language="javascript">';
				echo 'alert("Thank you for the review ' . $userSaved->getFirstName() . '")';
				echo '</script>';
			}
		};
	}
}
?>
<div class="wrapper">
	<img src="https://static01.nyt.com/images/2016/02/09/dining/09COOKING_CHICKENWINGS2/09COOKING_CHICKENWINGS2-superJumbo.jpg" id=bg alt="wings">
	<div id="userAccount" class="inputbox container">
		<form id="userForm" class="mb-0" action='' method="post">
			<div class="row my-3">
				<div class="col-12">
					<h3 class="fw-bold">Sign up for a Starbulls Account</h3>
				</div>
				<div class="col-lg-5 col-md-6 col-sm-12">
					<label class="form-label" for="">First Name</label><input type="text" name="firstName" id="firstName" class="form-control" <?= (isset($_POST['firstName']) ? 'value="' . $_POST['firstName'] . '"' : '') ?> <?= (isset($error['firstName']) ? 'class="is-invalid" ' : '') ?> required /> <?= $error['firstName'] ?? '' ?>
				</div>
				<div class="col-lg-5 col-md-6 col-sm-12">
					<label class="form-label" for="">Last Name:</label><input type="text" name="lastName" id="lastName" class="form-control" <?= (isset($_POST['lastName']) ? 'value="' . $_POST['lastName'] . '"' : '') ?> <?= (isset($error['lastName']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['lastName'] ?? '' ?>
				</div>
				<div class="col-lg-2 col-md-12 col-sm-12">
					<label class="form-label" for="">Phone Number:</label><input type="tel" name="tel" id="tel" class="form-control" <?= (isset($_POST['tel']) ? 'value="' . $_POST['tel'] . '"' : '') ?> />
				</div>
				<div class="col-lg-5 col-md-6 col-sm-12 my-2">
					<label class="form-label" for="">Enter an Email</label><input type="email" id="email" name="userEmail" class="form-control" placeholder="email@example.com" <?= (isset($_POST['userEmail']) ? 'value="' . $_POST['userEmail'] . '"' : '') ?> <?= (isset($error['email']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['email'] ?? '' ?>
				</div>
				<div class="col-lg-5 col-md-6 col-sm-12 my-2">
					<label class="form-label" for="">Enter your Password (8 characters minimum):</label><input type="password" id="password" class="form-control" name="password" minlength="8" <?= (isset($_POST['password']) ? 'value="' . $_POST['password'] . '"' : '') ?> <?= (isset($error['password']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['password'] ?? '' ?>
				</div>
				<div class="row">
					<div class="col-lg-2 col-sm-12 mt-2 mb-0 ">
						<input type="submit" class="btn btn-outline-success text-dark btn-lg" name="userSubmit" value="Submit" />
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

