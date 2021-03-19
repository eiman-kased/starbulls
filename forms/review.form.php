<?php

$comment = '';
$score = '';
$user_id = '';

$error = array();

if (isset($_POST['submit_btn'])) {
	if (!empty($_POST['comment'])) {
		$comment = trim($_POST['comment']);
	} else {
		$error['comment'] = 'Please leave a message.';
	}

	if (!empty($_POST['score'])) {
		$score = ($_POST['score']);
	} else {
		$error['score'] = 'Leave a Rating';
	}
}

?>

<form>

</form>