<?php

require_once 'src/User.php';
require_once 'src/Review.php';

$comment = '';
$score = '';
$userEmail = '';
$userId = 0;

$error = array();

if (isset($_POST['reviewSubmit'])) {
	var_dump($_POST);
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

	if (!$user) {
		echo 'Please create an Account';
		include 'forms/user.form.php';
	}
	$review = new Review($score, $comment, 0);
	//var_dump($review);
	//var_dump($user);
}

?>

<form method="post" action="">
	Enter an Email<input type="email" id="userEmail" name="userEmail" placeholder="email@example.com" required <?= (!empty($userEmail) ? 'value="' . $userEmail . '"' : '') ?> <?= (isset($error['userEmail']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['userEmail'] ?? '' ?>
	Score Rating:<input type="number" step="0.5" name="score" value='<?= (is_numeric($score) ? $score : '') ?>' <?= (isset($error['score']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['score'] ?? '' ?>
	Please Leave a Message Here:<textarea id="comment" name="comment" rows="5" cols="50" <?= (isset($error['comment']) ? 'class="is-invalid"' : '') ?> required><?= (!empty($comment) ? $comment : '') ?> </textarea> <?= $error['comment'] ?? '' ?>

	<input type="submit" name="reviewSubmit" value="Submit" />
</form>