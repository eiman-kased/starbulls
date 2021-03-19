<?php

require_once 'src/User.php';

$firstName = '';
$lastName = '';
$tel = '';
$email = '';
$password = '';

$error = array();

if (isset($_POST['userSubmit'])) {
	if (!empty(trim($_POST['firstName']))) {
		$firstName = trim($_POST['firstName']);
	} else {
		$error['firstName'] = 'First Name is Required';
	}

	if (!empty(trim($_POST['lastName']))) {
		$lastName = trim($_POST['lastName']);
	} else {
		$error['lastName'] = 'Last Name is Required';
	}

	if (!empty(trim($_POST['tel']))) {
		$tel = trim($_POST['tel']);
	} else {
		$error['tel'] = 'Phone Number is Required';
	}

	if (!empty(trim($_POST['email']))) {
		$email = trim($_POST['email']);
	} else {
		$error['email'] = 'An Email Address is Required';
	}

	if (!empty(trim($_POST['password']))) {
		$password = trim($_POST['password']);
	} else {
		$error['password'] = 'Enter your Password';
	}

	$user = new User($firstName, $lastName, $email, $password, $tel, false);
	$userSaved = $user->saveToDB();
	if ($userSaved) {
		echo '<h1>User Saved</h1>';
		echo 'confirmation email sent to ' . $user->getEmail();
		var_dump($user);
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