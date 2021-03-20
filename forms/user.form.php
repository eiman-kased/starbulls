<?php

// display errors so we know if there is a problem
ini_set('display_errors', 1);

// call session_start so we can utilize the $_SESSION super global to passed from the review form if it exists 
if (session_status() === PHP_SESSION_NONE) {
	session_start();
} else if (session_status() === PHP_SESSION_DISABLED) {
	echo 'sessions disabled, fix php';
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

// echo '$_POST<pre>';
// var_dump($_POST);
// echo '</pre>';

echo '$_SESSION<pre>';
var_dump($_SESSION);
echo '</pre>';

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
	echo '$_POST<pre>';
	var_dump($_POST);
	echo '</pre>';
}

// check to see if the submit button was clicked on the user form
if (isset($_POST['userSubmit'])) {
	// echo '$_POST<pre>';
	// var_dump($_POST);
	// echo '</pre>';

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
	var_dump($userSaved);

	// checks if $userSaved is successful
	if ($userSaved) {
		// TODO determine if we are going to display a message
		echo 'User Saved';
		// echo 'confirmation email sent to ' . $user->getEmail();
		// debugging
		// var_dump($user);
	} else {
		// displays error message if user cannot be saved
		echo 'Error saving user!';
	}

	// checks to see if review form has been submitted previously
	if (isset($_SESSION['review_submit'])) {
		// sets $reviewJSON to an associative array of review data
		$reviewJSON = json_decode($_SESSION['review_submit'], true);
		// var_dump($reviewJSON);

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

<form action='' method="post">
	First Name:<input type="text" name="firstName" id="firstName" <?= (isset($_POST['firstName']) ? 'value="' . $_POST['firstName'] . '"' : '') ?> <?= (isset($error['firstName']) ? 'class="is-invalid" ' : '') ?> required /> <?= $error['firstName'] ?? '' ?>
	Last Name:<input type="text" name="lastName" id="lastName" <?= (isset($_POST['lastName']) ? 'value="' . $_POST['lastName'] . '"' : '') ?> <?= (isset($error['lastName']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['lastName'] ?? '' ?>
	Phone Number:<input type="tel" name="tel" id="tel" <?= (isset($_POST['tel']) ? 'value="' . $_POST['tel'] . '"' : '') ?> />
	Enter an Email<input type="email" id="email" name="userEmail" placeholder="email@example.com" <?= (isset($_POST['userEmail']) ? 'value="' . $_POST['userEmail'] . '"' : '') ?> <?= (isset($error['email']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['email'] ?? '' ?>
	Enter your Password (8 characters minimum):<input type="password" id="password" name="password" minlength="8" <?= (isset($_POST['password']) ? 'value="' . $_POST['password'] . '"' : '') ?> <?= (isset($error['password']) ? 'class="is-invalid"' : '') ?> required> <?= $error['password'] ?? '' ?>

	<input type="submit" name="userSubmit" value="Submit" />
</form>