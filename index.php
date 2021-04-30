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

		<!-- Hero Image, Intro Text -->
		<div class="row gx-0">
			<div id="indexCarousel" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner hero-specials">
					<img src="imgs/coffee1.png">
					<div class="carousel-item active hero-text my-4">
						<div class="">
							<h2>Only the best of the best here at StarBulls</h2>
							<p>At StarBulls we strive to provide our customers with the best ingredients. You can be assured that we only purchase high-quality ingredients that are ethically sourced.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- main page content -->
		<div class="mainContent">
			<!-- hours of operation -->
			<div class="row my-2">
				<div id="hours">
					<h3 class="fw-bold">Hours of Operation</h3>
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
			<!-- Carousel of Customer Reviews -->
			<div class="row container col-sm-12 col-lg-9">
				<div id="reviewCarousel" class="carousel slide col-sm-12 col-lg-9" data-bs-ride="carousel">
					<div id="testimonials" class="row col-sm-12 col-lg-9">
						<h3 class="fw-bold">What people are saying about StarBulls:</h3>
						<div id="reviews-carousel" class="carouselReviews carousel-inner col-sm-12 col-lg-8">
							<div class="carousel-item review-item active col-sm-12 col-lg-8">
								<div data-review_id="review_reviewId" class="customerReview">
									<img src="imgs/starbulls_icon.png" alt="starbulls icon" id="reviewIcon">
									<div id="userInfo">
										<p id="email" class="reviewEmail">sallyjones@email.com</p>
									</div>
									<blockquote>
										<p class="comment">
											The place I go for my wings and coffee fix!
										</p>
									</blockquote>
									<p class="score">Score Rating:
										<img src="imgs/scoreCoffeeCup4.png" class="scoreCup">
									</p>
								</div>
							</div>
							<div class="carousel-item review-item col-sm-12 col-lg-8">
								<div data-review_id="review_reviewId" class="customerReview">
									<img src="imgs/starbulls_icon.png" alt="starbulls icon" id="reviewIcon">
									<div id="userInfo">
										<p id="email" class="reviewEmail">mikeb@email.com</p>
									</div>
									<blockquote>
										<p class="comment">
											StarBulls is my Thursday night wings spot!
										</p>
									</blockquote>
									<p class="score">Score Rating:
										<img src="imgs/scoreCoffeeCup5.png" class="scoreCup">
									</p>
								</div>
							</div>
							<div class="carousel-item review-item col-sm-12 col-lg-8">
								<div data-review_id="review_reviewId" class="customerReview">
									<img src="imgs/starbulls_icon.png" alt="starbulls icon" id="reviewIcon">
									<div id="userInfo">
										<p id="email" class="reviewEmail">cj357@email.com</p>
									</div>
									<blockquote>
										<p class="comment">
											Great wings, but the coffee was weak.
										</p>
									</blockquote>
									<p class="score">Score Rating:
										<img src="imgs/scoreCoffeeCup2.png" class="scoreCup">
									</p>
								</div>
							</div>
						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev">
							<span class="carousel-control-prev-icon review-controlR" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next">
							<span class="carousel-control-next-icon review-controlL" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
					</div>
				</div>
			</div>
			<!-- Review Form -->
			<div class="row">
				<form id="reviewForm" method="post" class="reviewSectionForm" action="">
					<h3 class="fw-bold">Tell Us About Your Experience at Starbulls</h3>
					<div class="row mb-3">
						<div class="col-9">
							<label class="form-label" for="userEmail">Enter an Email</label>
							<input type="email" id="userEmail" class="form-control" name="userEmail" placeholder="email@example.com" required />
						</div>
						<div class="col">
							<label class="form-label" for="reviewScore">Score Rating</label>
							<input type="number" id="reviewScore" class="form-control" step="0.5" name="score" min="0" max="5" required />
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<label class="form-label" for="comment">Please Leave a Message Here</label>
							<textarea id="comment" class="form-control" name="comment" rows="5" cols="50" required></textarea>
						</div>
					</div>
					<div class="centerBtn">
						<input type="submit" id="ReviewSubmit" class="btn btn-success" name="reviewSubmit" value="Submit" />
					</div>
				</form>
			</div>
			<!-- end of Review Form -->
			<!-- start of User Form -->
			<div id="showSignUpBtn" class=" col-2 btn btn-success" onclick="showUserForm()">Sign Up For a Starbulls Account</div>
			<div class="row">
				<form id="userForm" class="reviewSectionForm" action='' method="post">
					<h3 class="fw-bold">Sign up for a Starbulls Account</h3>
					<div class="row mb-3">
						<div class="col-6">
							<label class="form-label" for="firstName">First Name</label>
							<input type="text" name="firstName" id="firstName" class="form-control" required />
						</div>
						<div class="col-6">
							<label class="form-label" for="lastName">Last Name</label>
							<input type="text" name="lastName" id="lastName" class="form-control" required />
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-6">
							<label class="form-label" for="phone">Phone Number</label>
							<input type="tel" name="phone" id="phone" class="form-control" />
						</div>
						<div class="col-6">
							<label class="form-label" for="email">Enter an Email</label>
							<input type="email" id="email" name="userEmail" class="form-control" placeholder="email@example.com" required />
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-6">
							<label class="form-label" for="password">Enter your Password (8 characters minimum)</label>
							<input type="password" id="password" class="form-control" name="password" minlength="8" required />
						</div>
					</div>
					<div class="centerBtn">
						<input type="submit" id="userSubmit" class="btn btn-success" name="userSubmit" value="Submit" />
					</div>
				</form>
			</div>
			<!-- end of User Form  -->
		</div>
	</div>
	</div>
	<!-- 5 slide carousel featuring specials and menu items -->
	<div id="specialsCarousel" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#specialsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#specialsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#specialsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
			<button type="button" data-bs-target="#specialsCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
			<button type="button" data-bs-target="#specialsCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
		</div>
		<div class="carousel-inner hero-specials">
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
		<button class="carousel-control-prev" type="button" data-bs-target="#specialsCarousel" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#specialsCarousel" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div><br />
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
	<!-- Footer with Address -->
	<?php include 'footer.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<script src="js/reviewApi.js"></script>
</body>

</html>
