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
	<nav class="navbar navbar-expand-lg sticky-top navbar-light" style="background-color: green">
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
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

	<div class="accordion accordion-flush" id="accordianMenu">
		<div class="accordion-item">
			<h2 class="accordion-header" id="coffee">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
					Specialty Coffee
				</button>
			</h2>
			<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="coffee" data-bs-parent="#accordianMenu">
				<div class="accordion-body collapse-in">
					<div id="specialtyList" <ul class="list-group">
						<li class="list-group-item">Hippie Dark Roast - $3.00</li><br />
						<li class="list-group-item">Seattle Blend - $2.00</li><br />
						<li class="list-group-item">Buffalo Wing Blend - $4.00</li><br />
						<li class="list-group-item">BBQ Mocha - $4.00</li><br />
						<li class="list-group-item">Jerked-Wing Crazy Blend - $4.00</li><br />
						<li class="list-group-item">Hot Franks Coffee - $4.50</li><br />
						<li class="list-group-item">Designer Pour Over Deluxe - $5.00</li><br />
						<li class="list-group-item">Flavored Coffee - $2.50</li><br />
						</ul>
					</div>
				</div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header" id="regularCoffee">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
						Regular Coffee
					</button>
				</h2>
				<div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="regularCoffee" data-bs-parent="#accordianMenu">
					<div class="accordion-body">
						<ul class="list-group">
							<li class="list-group-item">Regular Cup'o Joe</li><br />
							<li class="list-group-item">Decaf - $2.00</li><br />
							<li class="list-group-item">Hot Chocolate - $2.00</li><br />
							<li class="list-group-item">Cafe Mocha - $2.00</li><br />
							<li class="list-group-item">Espresso - $3.50</li><br />
							<li class="list-group-item">Espresso Mugallo - $3.50</li><br />
							<li class="list-group-item">Italian Roast - $3.00</li><br />
						</ul>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="accordion-item">
		<h2 class="accordion-header" id="breakfastSingles">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				Breakfast Singles
			</button>
		</h2>
		<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="breakfastSingles" data-bs-parent="#accordianMenu">
			<div class="accordion-body">
				<ul class="list-group">
					<li class="list-group-item">Bagel - $4.99</li><br />
					<li class="list-group-item">Quick Breakfast Wrap - $7.99</li><br />
					<li class="list-group-item">Bake N Eggs - $11.99</li><br />
					<li class="list-group-item">Steak N Eggs - $11.99</li><br />
					<li class="list-group-item">Quick Scramble - $6.99</li><br />

				</ul>
			</div>
		</div>
	</div>
	<div class="accordion-item">
		<h2 class="accordion-header" id="breakfastCombos">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				Breakfast Combos
			</button>
		</h2>
		<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="breakfastCombos" data-bs-parent="#accordianMenu">
			<div class="accordion-body">
				<ul class="list-group">
					<li class="list-group-item">Green Shake Eggs & Ham $13.99</li><br />
					<li class="list-group-item">Breakfast Sam (Your Choice Breakfast Sandwich) - $15.99</li><br />
					<li class="list-group-item">Pancake Thangs (Combo Meal/Two Sides) - $14.50</li><br />
					<li class="list-group-item">Grandads French Toast & Thangs (Combo Meal/Two Sides)- $14.50</li><br />
					<li class="list-group-item">Breakfast Feast (Sample of all breakfast entrees and sides + Open Bar) - $300</li><br />
				</ul>
			</div>
		</div>
	</div>
	<div class="accordion-item">
		<h2 class="accordion-header" id="traditionalWings">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
				Traditional Wings - $13.99/10p | $21.99/21p
			</button>
		</h2>
		<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="traditionalWings" data-bs-parent="#accordianMenu">
			<div class="accordion-body">
				<ul class="list-group">
					<li class="list-group-item">BBQ</li><br />
					<li class="list-group-item">Honey Mustard</li><br />
					<li class="list-group-item">Mild</li><br />
					<li class="list-group-item">Medium</li><br />
					<li class="list-group-item">Hot</li><br />
					<li class="list-group-item">Honey BBQ</li><br />
					<li class="list-group-item">Lemon Pepper</li><br />
					<li class="list-group-item">Cajun</li><br />

				</ul>
			</div>
		</div>
	</div>

	<div class="accordion-item">
		<h2 class="accordion-header" id="specialityWings">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
				StarBulls Specialty Wings
			</button>
		</h2>
		<div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="specialityWings" data-bs-parent="#accordianMenu">
			<div class="accordion-body">
				<ul class="list-group">
					<li class="list-group-item">Macchiato Wings</li><br />
					<li class="list-group-item">Caramel Wings</li><br />
					<li class="list-group-item">Vanilla Wings</li><br />
					<li class="list-group-item">Mocha Wings</li><br />
					<li class="list-group-item">Salted Caramel Wings</li><br />
					<li class="list-group-item">Sugar Cookie Wings</li><br />
					<li class="list-group-item">Jamaican Me Crazy Jerked Wings</li><br />
					<li class="list-group-item">HazelNut Wings</li><br />
					<li class="list-group-item">French Vanilla Ranch Dip Wings</li><br />
					<li class="list-group-item">Pumpkin Spice Wings</li><br />
					<li class="list-group-item">Starbulls Saturday Special Sauce*</li><br />
				</ul>
			</div>
		</div>
	</div>

	<div class="accordion-item">
		<h2 class="accordion-header" id="bullsDinner">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
				Bulls Dinner
			</button>
		</h2>
		<div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="bullsDinner" data-bs-parent="#accordianMenu">
			<div class="accordion-body">
				<ul class="list-group">
					<li class="list-group-item">Burgers and Fries</li><br />
					<li class="list-group-item">Chicken Fingers and Fries</li><br />
					<li class="list-group-item">Fish and Fries</li><br />
				</ul>
			</div>
		</div>
	</div>

	<div class="accordion-item">
		<h2 class="accordion-header" id="sides">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
				Sides
			</button>
		</h2>
		<div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="sides" data-bs-parent="#accordianMenu">
			<div class="accordion-body">
				<ul class="list-group">
					<li class="list-group-item">Eggs :Scrambled,Over Easy,Sunny Side,Boiled</li><br />
					<li class="list-group-item">Great Grandads Grits</li><br />
					<li class="list-group-item">Sausage</li><br />
					<li class="list-group-item">Cream of Wheat</li><br />
					<li class="list-group-item">Oatmeal</li><br />
					<li class="list-group-item">Fruit</li><br />
					<li class="list-group-item">Yogurt</li><br />
					<li class="list-group-item">Butterfly Milk</li><br />
					<li class="list-group-item">Overnight Oats</li><br />
					<li class="list-group-item">Granny Nolas Granola</li><br />
				</ul>
			</div>
		</div>
	</div>

	</div>
	</div>

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