<?php
//display errors so we know if there is a problem
ini_set('display_errors', 1);

// we need the User and Review classes
require_once 'src/User.php';
require_once 'src/Review.php';

// initialize empty variables
$comment = '';
$score = '';
$userEmail = '';
$userId = 0;

// set an empty error array
$error = array();

// check to see if the submit button was clicked on review form
if (isset($_POST['reviewSubmit'])) {

	// make sure comment isn't empty
	if (!empty($_POST['comment'])) {
		// set comment to user comment sans whitespace
		$comment = trim($_POST['comment']);
	} else {
		// if comment is not set, add error message to array to be displayed later
		$error['comment'] = 'Please leave a message.';
	}

	// check score is set to a numeric value
	if (is_numeric($_POST['score'])) {
		// set score to accept float value of user input
		$score = floatval($_POST['score']);
	} else {
		// if score is not set, add error message to array to be displayed later
		$error['score'] = 'Leave a Rating';
	}

	// check to see that the trimmed version of userEmail is not empty
	if (!empty(trim($_POST['userEmail']))) {
		// set userEmail to the user email sans whitespace
		$userEmail = trim($_POST['userEmail']);
	} else {
		// if userEmail is empty, add error message to array to be displayed later
		$error['userEmail'] = 'Please Enter you Email';
	}

	// creating a new review object
	$review = new Review($score, $comment, null);

	// seeing if the user already exists based on email so we can get the userId based on review
	$user = \User::findUserByEmail($userEmail);

	// check to see if the user exists
	if (!$user) {
		//if the user doesn't exist, we need to try to create a user
		// call session_start so we can utilize the $_SESSION super global to pass data to the user form
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}

		// set review_submit element to the JSON value of review object
		$_SESSION['review_submit'] = json_encode($review);

		// set review_post element to the JSON value of $_POST object
		$_SESSION['review_post'] = json_encode($_POST);

		// redirects the user to the signup page
		$URL = 'signup.php';
		echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
		echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
	} else {
		// if user does exist, set the found user's ID as userID property of $review.
		$review->setUserId($user->getId());

		//save $review object to database
		$review->saveToDB();
		if ($review->getUserID()) {
			echo '<script language="javascript">';
			echo 'alert("Thank you for your review!")';
			echo '</script>';
		}
	}
}
?>
<div class="inputbox container">
	<div id="reviewForm" class="row my-3">
		<form method="post" action="">
			<div class="row my-3 ">
				<div class="colform col-12">
					<h3 class="fw-bold">Tell Us About Your Experience at Starbulls</h3>
				</div>
				<div class="colform col-lg-8 col-sm-8">
					<label class="form-label" for="">Enter an Email</label><input type="email" id="userEmail" class="form-control" name="userEmail" placeholder="email@example.com" required <?= (!empty($userEmail) ? 'value="' . $userEmail . '"' : '') ?> <?= (isset($error['userEmail']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['userEmail'] ?? '' ?>
				</div>
				<div class="colform col-lg-2 col-sm-4">
					<label class="form-label" for="">Score Rating:</label><input type="number" id="reviewScore" class="form-control" step="0.5" name="score" min="0" max="5" <?= (is_numeric($score) ? "value='$score'" : '') ?>' <?= (isset($error['score']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['score'] ?? '' ?>
				</div>
				<div class="colform col-lg-12">
					<label class="form-label" for="">Please Leave a Message Here:</label><textarea id="comment" class="form-control" name="comment" rows="5" cols="50" <?= (isset($error['comment']) ? 'class="is-invalid"' : '') ?> required><?= (!empty($comment) ? $comment : '') ?> </textarea> <?= $error['comment'] ?? '' ?>
				</div>
				<div class="colform col-lg-2 my-3">
					<input type="submit" id="ReviewSubmit" class="btn btn-outline-success btn-lg" name="reviewSubmit" value="Submit" />
				</div>
			</div>
		</form>
	</div>
</div>
