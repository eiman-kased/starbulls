<?php
ini_set('display_errors', 1);

require_once 'src/User.php';
require_once 'src/Review.php';

$comment = '';
$score = '';
$userEmail = '';
$userId = 0;

$error = array();

if (isset($_POST['reviewSubmit'])) {
	// debugging, leave in for now
	// echo '<pre>';
	// var_dump($_POST);
	// echo '</pre>';
	if (!empty($_POST['comment'])) {
		$comment = trim($_POST['comment']);
	} else {
		$error['comment'] = 'Please leave a message.';
	}

	if (is_numeric($_POST['score'])) {
		$score = floatval($_POST['score']);
	} else {
		$error['score'] = 'Leave a Rating';
	}

	if (!empty(trim($_POST['userEmail']))) {
		$userEmail = trim($_POST['userEmail']);
	} else {
		$error['userEmail'] = 'Please Enter you Email';
	}


	$user = \User::findUserByEmail($userEmail);
	$review;

	$review = new Review($score, $comment);

	if (!$user) {
		session_start();
		$_SESSION['review_submit'] = json_encode($review);
		$_SESSION['review_post'] = json_encode($_POST);
		// var_dump($review);
		header('Location:signup.php');
	} else {
		$review->setUserId($user->getId());
		// echo '<pre>';
		// var_dump($review);
		// var_dump($user);
		// echo '</pre>';

		$review->saveToDB();
	}
}

?>

<form method="post" action="">
	Enter an Email<input type="email" id="userEmail" name="userEmail" placeholder="email@example.com" required <?= (!empty($userEmail) ? 'value="' . $userEmail . '"' : '') ?> <?= (isset($error['userEmail']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['userEmail'] ?? '' ?>
	Score Rating:<input type="number" step="0.5" name="score" value='<?= (is_numeric($score) ? $score : '') ?>' <?= (isset($error['score']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['score'] ?? '' ?>
	Please Leave a Message Here:<textarea id="comment" name="comment" rows="5" cols="50" <?= (isset($error['comment']) ? 'class="is-invalid"' : '') ?> required><?= (!empty($comment) ? $comment : '') ?> </textarea> <?= $error['comment'] ?? '' ?>

	<input type="submit" name="reviewSubmit" value="Submit" />
</form>