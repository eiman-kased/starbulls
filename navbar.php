<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<nav class="navbar navbar-expand-lg sticky-top navbar-light navbar-custom">
	<div class="container-fluid">
		<div class="logo">
			<a href="index.php" class="logo">
				<img src="images/starbulls_logo.png" alt="logo" />
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
						OUR MENUS
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<li><a class="dropdown-item" href="menu.php#coffee" id="specialCoffee">Specialty Coffee</a></li>
						<li><a class="dropdown-item" href="menu.php#regularcoffee" id="coffee">Coffee</a></li>
						<li><a class="dropdown-item" href="menu.php#breakfastsingles" id="breakfastSingles">Breakfast Singles</a></li>
						<li><a class="dropdown-item" href="menu.php#breakfastcombos" id="breakfastcombos">Breakfast Combos</a></li>
						<li><a class="dropdown-item" href="menu.php#traditionalwings" id="tradWings">Traditional Wings</a></li>
						<li><a class="dropdown-item" href="menu.php#specialitywings" id="starWings">Starbulls Specialty Wings</a></li>
						<li><a class="dropdown-item" href="menu.php#bullsDinner" id="bullsDinner">Bulls Dinner</a></li>
						<li><a class="dropdown-item" href="menu.php#sides" id="sides">Sides</a></li>
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
	</div>
</nav>
<script src="js/indicator.js"></script>
<script>
	$(document).load(indicate());
	$(document).load(menuHighlight());
</script>