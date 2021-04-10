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
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
	<div class="container-fluid p-0 graybg">
		<!-- Logo and Navigation Bar -->
		<?php include 'navbar.php'; ?>

		<!-- Hero Image, Intro Text, Hours of Operation -->
		<div class="row gx-0">
			<div id="indexCarousel" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<img src="imgs/cofee1.png">
					<div class="carousel-item active hero-text my-4">
						<div class="">
							<h2>Only the best of the best here at StarBulls</h2>
							<p>At StarBulls we strive to provide our customers with the best ingredients. You can be assured that we only purchase high-quality ingredients that are ethically sourced.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row my-2">
			<div id="hours">
				<h4 class="display-6">Hours of Operation</h4>
				<table class="table">
					<tr>
						<td>Monday - Friday</td>
						<td>Saturday</td>
						<td>Sunday</td>
					</tr>
					<tr>
						<td>9AM - 7PM</td>
						<td>9AM - 9PM</td>
						<td>*Closed*</td>
					</tr>
				</table>
			</div>
		</div>
		<!-- 5 slide carousel featuring specials and menu items -->
		<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-indicators">
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
			</div>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="imgs/coffee.jpg" class="d-block w-100" alt="pouring coffee">
					<div class="carousel-caption">
						<h3>StarBulls Selection of Coffee</h3>
						<p>A selection of coffee to satisfy your taste.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="imgs/chickenwings2.jpg" class="d-block w-100" alt="plate of chicken wings">
					<div class="carousel-caption">
						<h3>Traditional and Specialty Wings</h3>
						<p>Chicken Wing flavors ranging from traditional to daring.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="imgs/hotchocolate.jpg" class="d-block w-100" alt="four mugs of hot chocolate">
					<div class="carousel-caption">
						<h3>Milk Chocolate Monday</h3>
						<p>Our Monday Special! Hot Milk Chocolate serving a party of four.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="imgs/burgerfries.jpg" class="d-block w-100" alt="burger and fries">
					<div class="carousel-caption">
						<h3>Bulls Dinner</h3>
						<p>Try our delicious Burgers and Fries.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="imgs/wingbuffet.jpg" class="d-block w-100" alt="chicken wing buffet">
					<div class="carousel-caption">
						<h3>Wingin' It Wednesday</h3>
						<p>Our Wednesday Special! All You Can Eat Chicken Wing Buffet!</p>
					</div>
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div><br />

		<!-- Customer Review Form -->
		<div class="row">
			<div class="col-6" id="IndexReviewForm">
				<?php include 'forms/review.form.php'; ?><br />
			</div>
			<div class="col-6" id="IndexUserForm">
			<?php include 'forms/user.form.php'; ?><br />
			</div>
			<!-- Carousel of Customer Reviews -->
			<div class="col-6">
				<div id="apiReview" class="review1">
					<div data-review_id="review_reviewId">
						<p>
							3
						</p>
						<p>
							food food food
						</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Social Media Call to Action -->
		<div class="social-bkg socialmedia">
			<h3>StarBulls offers the very best of Wings, Coffee and More!</h3>
			<h4>Follow us on Social Media for Special Offers, Updates and more!</h4>
			<div class="social-pic">
				<img src="imgs/contactUs.jpeg" alt="contact us">
				<img src="imgs/chickenWings.jpg" alt="chicken wings">
				<img src="imgs/coffeesocial.jpg" alt="follow us">
			</div>
			<div class="social-links">
				<img src="imgs/facebook.svg" alt="facebook icon"><a href="https://www.facebook.com/starbulls.buffalo/"> Facebook: Starbulls-buffalo | </a>
				<img src="imgs/instagram.svg" alt="instagram icon"><a href="https://www.instagram.com/starbulls716/"> Instagram: starbulls716 | </a>
				<img src="imgs/twitter.svg" alt="twitter icon"><a href="https://twitter.com/login"> Twitter: starbulls716</a><br />
			</div>
		</div><br />
	</div>
	<!-- Footer with Address -->
	<?php include 'footer.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<script src="js/reviewApi.js"></script>
</body>

</html>
