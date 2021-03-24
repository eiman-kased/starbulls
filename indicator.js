function indicate() {
  if (basename(__FILE__) == about.php) {
    $(aboutPage).toggleClass("active");
  } else if (basename(__FILE__) == apply.php) {
    $(apply).toggleClass("active");
  } else if (basename(__FILE__) == menu.php) {
    $(menus).toggleClass("active");
  } else if (basename(__FILE__) == specialMenu.php) {
    $(weekly).toggleClass("active");
  }
}
