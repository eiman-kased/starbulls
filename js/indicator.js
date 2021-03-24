function indicate() {
	$(document).ready(function () {
		var currentPage = window.location.pathname.substring(window.location.pathname.lastIndexOf('/') + 1);
		//var thePage = currentPage.substring(currentPage.lastIndexOf('/') + 1);
		switch (currentPage) {
				case "index.php":
				console.log("click action");
				$(".nav-item.nav-active").removeClass("nav-active");
				$('a[href="index.php"').parent().addClass("nav-active");
				break;
			case "about.php":
				console.log("click action");
				$(".nav-item.nav-active").removeClass("nav-active");
				$('a[href="about.php"').parent().addClass("nav-active");
				break;
			case "menu.php":
				console.log("click action");
				$(".nav-item.nav-active").removeClass("nav-active");
				$('a[href="menu.php"').parent().addClass("nav-active");
				break;
			case "specialMenu.php":
				console.log("click action");
				$(".nav-item.nav-active").removeClass("nav-active");
				$('a[href="specialMenu.php"').parent().addClass("nav-active");
				break;
			case "apply.php":
				console.log("click action");
				$(".nav-item.nav-active").removeClass("nav-active");
				$('a[href="apply.php"').parent().addClass("nav-active");
				break;
			default:
				console.log($("No matching element found."));
				break;
		}
	});
}
