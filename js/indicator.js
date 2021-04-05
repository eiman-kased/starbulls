// function indicate() {
//   $(document).ready(function () {
//     var currentPage = window.location.pathname.substring(
//       window.location.pathname.lastIndexOf("/") + 1
//     );
//     switch (currentPage) {
//       case "index.php":
//         $(".nav-item.nav-active").removeClass("nav-active");
//         $('a[href="index.php"').parent().addClass("nav-active");
//         break;
//       case "about.php":
//         $(".nav-item.nav-active").removeClass("nav-active");
//         $('a[href="about.php"').parent().addClass("nav-active");
//         break;
//       case "menu.php":
//         $(".nav-item.nav-active").removeClass("nav-active");
//         $('a[href="menu.php"').parent().addClass("nav-active");
//         break;
//       case "specialMenu.php":
//         $(".nav-item.nav-active").removeClass("nav-active");
//         $('a[href="specialMenu.php"').parent().addClass("nav-active");
//         break;
//       case "apply.php":
//         $(".nav-item.nav-active").removeClass("nav-active");
//         $('a[href="apply.php"').parent().addClass("nav-active");
//         break;
//       default:
//         console.log($("No matching element found."));
//         break;
//     }
//   });
// }


function indicate(){
 $(document).ready(function () {
  $('.navbar-nav a').filter(function(){
    return this.href===location.href}).parent().addClass('nav-active').siblings().removeClass('nav-active');
  $('.nav-link').click(function(){
    $(this).parent().addClass('nav-active').siblings().removeClass('nav-active')	
  })
})
};