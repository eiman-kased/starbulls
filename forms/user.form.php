<?php
$firstName = '';
$lastName = '';
$tel = '';
$email = '';
$password = '';

$error = array();

if (isset($_POST["submit_btn"])) {
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
}
?>

<form action='' method="post">
	<div class="name">
		First Name:<input type="text" name="firstName" id="firstName" <?= (isset($_POST['firstName']) ? 'value="' . $_POST['firstName'] . '"' : '') ?> <?= (isset($error['firstName']) ? 'class="is-invalid" ' : '') ?> required /> <?= $error['firstName'] ?? '' ?>

		Last Name:<input type="text" name="lastName" id="lastName" <?= (isset($_POST['lastName']) ? 'value="' . $_POST['lastName'] . '"' : '') ?> <?= (isset($error['lastName']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['lastName'] ?? '' ?>

	</div>

	<div class="tel">
		Phone Number:<input type="tel" name="tel" id="tel" <?= (isset($_POST['tel']) ? 'value="' . $_POST['tel'] . '"' : '') ?> />

	</div>

	<div class="email">
		Enter an Email<input type="email" id="email" name="email" placeholder="email@example.com" <?= (isset($_POST['email']) ? 'value="' . $_POST['email'] . '"' : '') ?> <?= (isset($error['email']) ? 'class="is-invalid"' : '') ?> required /> <?= $error['email'] ?? '' ?>

		</br></br>
	</div>

	<div class="password">
		Enter your Password (8 characters minimum):<input type="password" id="password" name="password" minlength="8" <?= (isset($_POST['password']) ? 'value="' . $_POST['password'] . '"' : '') ?> <?= (isset($error['password']) ? 'class="is-invalid"' : '') ?> required> <?= $error['password'] ?? '' ?>

	</div>

	<div class="submit">
		<input type="submit" name="submit_btn" value="Submit Application" />
	</div>

</form>