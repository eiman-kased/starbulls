<?php
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Apply</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css\starbull.css">
</head>

<body>
	<?php include 'navbar.php'; ?>
	<div id="socialMedia">
		<a href="https://www.instagram.com/starbulls716/" class="btn btn-default" target="_blank">
			<img src="images\instagram.png" alt="Instagram"></a>
		<a href="https://www.facebook.com/starbulls.buffalo/" class="btn btn-default" target="_blank">
			<img src="images\fb.png" alt="facebook"></a>
		<a href="https://twitter.com/home/" class="btn btn-default" target="_blank">
			<img src="images\_twitter.png" alt="twitter"></a>
	</div>

	<div class="hero">
		<div class="hero-text">
			<h2>Become a Part of the StarBulls</h2>
			<p>Apply Today!</p>
		</div>
	</div>

	<div id="columns">
		<div class="column-wrap">
			<div class="column-left">
				<!--left content-->
				<h2>Application</h2>
				<h3>*required fields</h3>
				<div class="form-container">
					<?php include 'forms/apply.form.php'; ?>
				</div>
			</div>
		</div>
		<div class="column-right">
			<h2>Reviews</h2>
			<div class="review1">
				<p>McLovin:"No fake ID required: they'll hire you at 16!"</p>
			</div> </br>

			<div class="review2">
				<p>Ragnar L:"Don’t waste your time looking back you are not going that way. Apply to StarBulls and change your life."</p>
			</div> </br>

			<div class="review1">
				<p>Uhtred:"What is it that you want? Great bosses and colleagues? Good pay? Then work at StarBulls"</p>
			</div> </br>

			<div class="review2">
				<p>Dwight S.:"Nothing stresses me out. Except having to seek the approval of my inferiors. Here at StarBulls I don't stress about this!</p>
			</div></br>

			<div class="review1">
				<p> Winnie T.P:"How lucky I am to have something that makes saying goodbye so hard."
				</p>
			</div> </br>

			<div class="review2">
				<p>John L: "StarBulls offers a great astmosphere; everyone is very relaxed!"</p>
			</div></br>
		</div>
	</div>
	</br>
	<?php include 'forms/user.form.php';?>
	<div id="end">
		<b>
			Starbulls Wings and Coffee&nbsp; |&nbsp; 01101000 01101001 00100000 01100010 01101001 01101100 01101100 Web Development Street&nbsp; |&nbsp; Buffalo , NY 14220&nbsp; |&nbsp;
		</b>

	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>