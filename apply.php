<?php
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
	<div class="container-fluid p-0">
		<?php include 'navbar.php'; ?>
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner hero-specials">
				<img src="imgs/coffee12.png" width="100%">
				<div class="item active">
					<div class="carousel-caption d-none d-md-block">
						<div class="hero-text">
							<h2>Become a Part of the StarBulls</h2>
							<p>Apply Today!</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row g-lg-5 gx-lg-5 mx-lg-5 ">
			<div class="col-lg-6 my-5">
				<!--left content-->
				<h2>Application</h2>
				<h3>*required fields</h3>
				<div class="apply-form-container">
					<?php include 'forms/apply.form.php'; ?>
				</div>
			</div>
			<div class="col-lg-6 my-lg-5">
				<!--right content-->
					<h2>Reviews</h2>
				<div class="review1 ">
					<p>McLovin:"No fake ID required: they'll hire you at 16!"</p>
				</div>
				<div class="review2">
					<p>Ragnar L:"Don’t waste your time looking back you are not going that way. Apply to StarBulls and change your life."</p>
				</div>
				<div class="review1">
					<p>Uhtred:"What is it that you want? Great bosses and colleagues? Good pay? Then work at StarBulls"</p>
				</div>
				<div class="review2">
					<p>Dwight S.:"Nothing stresses me out. Except having to seek the approval of my inferiors. Here at StarBulls I don't stress about this!</p>
				</div>
				<div class="review1">
					<p> Winnie T.P:"How lucky I am to have something that makes saying goodbye so hard."</p>
				</div>
				<div class="review2">
					<p>John L: "StarBulls offers a great astmosphere; everyone is very relaxed!"</p>
				</div>
			</div>
		</div>
		<?php include 'footer.php'; ?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>
