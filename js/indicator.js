function indicate() {
  $(document).ready(function () {
	var currentPage = window.location.pathname.substring(
	  window.location.pathname.lastIndexOf("/") + 1
	);
	switch (currentPage) {
	  case "index.php":
		$(".nav-item.nav-active").removeClass("nav-active");
		$('a[href="index.php"').parent().addClass("nav-active");
		break;
	  case "about.php":
		$(".nav-item.nav-active").removeClass("nav-active");
		$('a[href="about.php"').parent().addClass("nav-active");
		break;
	  case "menu.php":
		$(".nav-item.nav-active").removeClass("nav-active");
		$('a[href="menu.php"').parent().addClass("nav-active");
		break;
	  case "specialMenu.php":
		$(".nav-item.nav-active").removeClass("nav-active");
		$('a[href="specialMenu.php"').parent().addClass("nav-active");
		break;
	  case "apply.php":
		$(".nav-item.nav-active").removeClass("nav-active");
		$('a[href="apply.php"').parent().addClass("nav-active");
		break;
	  default:
		console.log($("No matching element found."));
		break;
	}
  });
}


<<<<<<< Updated upstream
function menuHighlight() {
  $(document).ready(function () {
	var allElements = $("a");
	$("ul.dropdown-menu")
	  .find(allElements)
	  .click(function () {
		$(this).toggleClass("nav-active");
	  });
  });
}

/*
this code will most likely be scratched.
function menuHighlight() {
  $(document).ready(function () {
	var allElements = $("id");
	var lookFor = $("ul.dropdown-menu").find(allElements);
	if (lookFor.find('one').click) {
	  $(this).toggleClass("nav-active");
	} else if (lookFor.find('two').two.click) {
	  $(this).toggleClass("nav-active");
	} else if (lookFor.find('three').click) {
	  $(this).toggleClass("nav-active");
	} else if (lookFor.find('four').click) {
	  $(this).toggleClass("nav-active");
	} else if (lookFor.find('five').click) {
	  $(this).toggleClass("nav-active");
	} else if (lookFor.find('six').click) {
	  $(this).toggleClass("nav-active");
	} else if (lookFor.find('seven').click) {
	  $(this).toggleClass("nav-active");
	} else if (lookFor.find('eight').click) {
	  $(this).toggleClass("nav-active");
	}
	else {
		break;
	}
  });
}
*/
=======
function findMenu(){
	$(document).ready (function () {
		var thePage = window.location.pathname;
		$(thePage).find("menu.php").css("background-color", "red");
	})}
>>>>>>> Stashed changes
