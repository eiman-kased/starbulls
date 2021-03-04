<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Menu</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css\menu.css">
</head>


<body>


	<nav class="navbar navbar-expand-lg fixed-top navbar-light" style="background-color: green">
		<div class="container-fluid">
			<div class="logo">
				<a href="home.php" class="logo">
					<img src="images/starbullslogo.png" alt="logo" />
				</a>
			</div>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="about.php">ABOUT US</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link active dropdown-toggle" aria-current="page" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							MENU
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<li><a class="dropdown-item" href="#cafe">Cafe</a></li>
							<li><a class="dropdown-item" href="#breakfastSingles">Breakfast</a></li>
							<li><a class="dropdown-item" href="#tradWings">Wings</a></li>
							<li><a class="dropdown-item" href="#dinner">Dinner+Sides</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="specialMenu.php">WEEKLY SPECIALS</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="apply.php">APPLY NOW</a>
					</li>
				</ul>
			</div>
	</nav>


	<article>
		<h2>MENU</h2>
		<div id="cafe">
			<h3>Cafe</h3>
		</div>
		<hr>
		<dt>Regular Cup'o Joe - $2.00</dt>
		<hr>
		<dt>Decaf - $2.00</dt>
		<hr>
		<dt>Hot - Chocolate - $2.00</dt>
		<hr>
		<dt>Cafe Mocha - $2.00</dt>
		<hr>
		<dt>Expresso - $3.50</dt>
		<hr>
		<dt>Expresso Mugallo - $3.50</dt>
		<hr>
		<dt>Italian Roast - $3.00</dt>
		<hr>
		<dt>Hippie Dark Roast - $3.00</dt>
		<hr>
		<dt>Seattle Blend - $2.00</dt>
		<hr>
		<dt>Buffalo Wing Blend - $4.00</dt>
		<hr>
		<dt>BBQ Mocha - $4.00</dt>
		<hr>
		<dt>Jerked-Wing crazy blend - $4.00</dt>
		<hr>
		<dt>Hot Franks Coffee - $4.50</dt>
		<hr>
		<dt>Designer Pour Over Deluxe - $5.00</dt>
		<hr>
		<dt>Flavored Coffee - $2.50</dt>
		<hr>
		<div id="breakfastSingles">
			<h3>BreakFast Singles</h3>
		</div>
		<hr>
		<dt>Bagel - $4.99</dt>
		<hr>
		<dt>Quick Breakfast Wrap - $7.99</dt>
		<hr>
		<dt>Quick Scramble - $6.99</dt>
		<hr>
		<div id="breakfastCombo">
			<h3>BreakFast Combos</h3>
		</div>
		<hr>
		<dt>Bake N Eggs - $11.99</dt>
		<hr>
		<dt>Steak N Eggs - $11.99</dt>
		<hr>
		<dt>Green Shake Eggs & Ham $13.99</dt>
		<hr>
		<dt>Breakfast Sam (Your Choice Breakfast Sandwich) - $15.99</dt>
		<hr>
		<dt>Pancake Thangs (Combo Meal/Two Sides) - $14.50</dt>
		<hr>
		<dt>Grandads French Toast & Thangs (Combo Meal/Two Sides)- $14.50</dt>
		<hr>
		<dt>Breakfast Feast (Sample of all breakfast entrees and sides + Open Bar) - $300</dt>
		<hr>
		<div id="tradWings">
			<h3>Traditional Wings - $13.99/10p | $21.99/21p</h3>
		</div>
		<hr>
		<dt>BBQ</dt>
		<dt>Honey Mustard</dt>
		<dt>Mild</dt>
		<dt>Medium</dt>
		<dt>Hot</dt>
		<dt>Honey BBQ</dt>
		<dt>Lemon Pepper</dt>
		<dt>Cajun</dt>
		<dt>Starbulls Saturday Special Sauce*</dt>
		<hr>
		<h3>StarBulls Specialty Wings</h3>
		<hr>
		<dt>Mocchiato Wings</dt>
		<hr>
		<dt>Caramel Wings</dt>
		<hr>
		<dt>Vanilla Wings</dt>
		<hr>
		<dt>Mocha Wings</dt>
		<hr>
		<dt>Salted Caramel Wings</dt>
		<hr>
		<dt>Sugar Cookie Wings</dt>
		<hr>
		<dt>Jamaican Me Crazy Jerked Wings</dt>
		<hr>
		<dt>HazelNut Wings</dt>
		<hr>
		<dt>French Vanilla Ranch Dip Wings</dt>
		<hr>
		<dt>Pumpkin Spice Wings</dt>
		<hr>
		<div id="dinner">
			<h3>Bulls Dinner</h3>
		</div>
		<dt>Burgers and Fries</dt>
		<hr>
		<dt>Fingers and Fries</dt>
		<hr>
		<dt>Fish and Fries</dt>


		<hr>
		<div id="sides">
			<h3>Sides</h3>
		</div>
		<hr>
		<dt>Eggs: Scrambled ~ Over Easy ~ Sunny Side ~ Boiled</dt>
		<dt>Great Grandads Grits</dt>
		<dt>Sausage</dt>
		<dt>Cream of Wheat</dt>
		<dt>Oatmeal</dt>
		<dt>Fruit Cup</dt>
		<dt>Yogurt</dt>
		<dt>Butterfly Milk</dt>
		<dt>Overnight Oats</dt>
		<dt>Granny Nolas Granola</dt>
		<hr>

	</article>



	<div id="socialMedia">
		<a href="https://www.instagram.com/starbulls716/" class="btn btn-default" target="_blank">
			<img src="images\instagram.png" alt="Instagram"></a>
		<a href="https://www.facebook.com/starbulls.buffalo/" class="btn btn-default" target="_blank">
			<img src="images\fb.png" alt="facebook"></a>
		<a href="https://twitter.com/home/" class="btn btn-default" target="_blank">
			<img src="images\_twitter.png" alt="twitter"></a>
	</div>
	<div id="end">
		<b>
			Starbulls Wings and Coffee&nbsp; |&nbsp; 01101000 01101001 00100000 01100010 01101001 01101100 01101100
			Web Development Street&nbsp; |&nbsp; Buffalo , NY 14220&nbsp; |&nbsp;
		</b>

	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>