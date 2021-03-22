<?php
ini_set('display_errors', 1);
// call session_start so we can utilize the $_SESSION super global
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>STARBULLS</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
	<?php include 'navbar.php'; ?>
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<img src="imgs/ingredients.jpeg" alt="Los Angeles" style="width:100%;">
				<div class="carousel-caption d-none d-md-block">
					<div name="ingredients" class="ingredients" id="ingredients">
						<div class="ingredients-text">
							<h2>Only the best of the best here at StarBulls</h2>
							<p>At StarBulls we strive to provide our customers with the best ingredients. You can be assured that we
								only purchase high-quality ingredients that are ethically sourced.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="hours">
		<h2>Hours of Operation</h2>
		<table class="table">
			<tr>
				<td>Sunday</td>
				<td>*Closed*</td>
			</tr>
			<tr>
				<td>Monday</td>
				<td>9AM-7PM</td>
			</tr>
			<tr>
				<td>Tuesday</td>
				<td>9AM-7PM</td>
			</tr>
			<tr>
				<td>Wednesday</td>
				<td>9AM-7PM</td>
			</tr>
			<tr>
				<td>Thursday</td>
				<td>9AM-7PM</td>
			</tr>
			<tr>
				<td>Friday</td>
				<td>9AM-7PM</td>
			</tr>
			<tr>
				<td>Saturday</td>
				<td>9AM-9PM</td>
			</tr>
		</table>
	</div></br></br>
	<div class="row">
		<div class="column">
			<div id="connect">
				<img src="imgs/contactUs.jpeg" />
			</div>
		</div>
		<div class="column">
			<div class="connectText">
				<h2>Connect with us on Social Media!</h2>
				<p>We'd love to hear from YOU!</p> </br>
				<p>Follow us to find out the latest buzz!</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="column">
			<div id="connect">
				<div class="connectTexts">
					<h2>Enjoy a Variety of Food!</h2>
					<p>We offer a variety of food and drinks to satisfy any and all cravings!</p> </br>
					<p>Head over to our menu page!</p>
				</div>
			</div>
		</div>
		<div class="column">
			<img src="imgs/chickenWings.jpg" />
		</div>
	</div> </br></br>
	<?php include 'forms/review.form.php'; ?>
	<?php include 'footer.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>