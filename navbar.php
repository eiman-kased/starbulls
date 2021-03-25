
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
			<ul class="navbar-nav nav-pills">
				<li class="nav-item">
					<a class="nav-link" href="about.php" id="aboutPage">ABOUT US</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						MENU
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="menus">
						<li><a class="dropdown-item" href="#cafe">Cafe</a></li>
						<li><a class="dropdown-item" href="#breakfastSingles">Breakfast</a></li>
						<li><a class="dropdown-item" href="#tradWings">Wings</a></li>
						<li><a class="dropdown-item" href="#dinner">Dinner+Sides</a></li>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="specialMenu.php" id="weekly">WEEKLY SPECIALS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="apply.php" id="apply">APPLY NOW</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<script src="js/indicator.js"></script>
<script>
	$(document).load(indicate());
</script>