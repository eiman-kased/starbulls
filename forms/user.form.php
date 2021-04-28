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
$phone = '';
$email = '';
$password = '';

// set an empty error array
$error = array();

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

	// check to make sure phone is not empty
	if (!empty(trim($_POST['phone']))) {
		// set phone to user phone sans whitespace
		$phone = trim($_POST['phone']);
	} else {
		//if it is empty, add error message to array to be displayed later
		$error['phone'] = 'Phone Number is Required';
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

	if (empty($password) || strlen($password) < 8) {
		throw new \InvalidArgumentException("Password cannot be empty and must be at least 8 characters");
	}

	// creating a new user object
	$user = new \User($firstName, $lastName, $email, $password, $phone, false);

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
		$review = new \Review($reviewJSON['score'], $reviewJSON['comment'], $userSaved->getId());

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
	// after successful submission the user will  be redirected to the home page
	$URL = 'index.php';
	echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
	echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
?>

<form id="userForm" class="reviewSectionForm" action='' method="post">
	<h3 class="fw-bold">Sign up for a Starbulls Account</h3>
	<div class="row mb-3">
		<div class="col-6">
			<label class="form-label" for="firstName">First Name</label>
			<input type="text" name="firstName" id="firstName" class="form-control" <?= (isset($_POST['firstName']) ? 'value="' . $_POST['firstName'] . '"' : '') ?> <?= (isset($error['firstName']) ? 'class="is-invalid" ' : '') ?> required /> <?= $error['firstName'] ?? '' ?>
		</div>
		<div class="col-6">
			<label class="form-label" for="lastName">Last Name</label>
			<input type="text" name="lastName" id="lastName" class="form-control" <?= (isset($_POST['lastName']) ? 'value="' . $_POST['lastName'] . '"' : '') ?> <?= (isset($error['lastName']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['lastName'] ?? '' ?>
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-6">
			<label class="form-label" for="phone">Phone Number</label>
			<input type="tel" name="phone" id="phone" class="form-control" <?= (isset($_POST['phone']) ? 'value="' . $_POST['phone'] . '"' : '') ?> />
		</div>
		<div class="col-6">
			<label class="form-label" for="email">Enter an Email</label>
			<input type="email" id="email" name="userEmail" class="form-control" placeholder="email@example.com" <?= (isset($error['email']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['email'] ?? '' ?>
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-6">
			<label class="form-label" for="password">Enter your Password (8 characters minimum)</label>
			<input type="password" id="password" class="form-control" name="password" minlength="8" <?= (isset($_POST['password']) ? 'value="' . $_POST['password'] . '"' : '') ?> <?= (isset($error['password']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['password'] ?? '' ?>
		</div>
	</div>
	<input type="submit" class="btn btn-success" name="userSubmit" value="Submit" />
</form>
