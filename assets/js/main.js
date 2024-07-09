$(document).ready(function () {
  var toggleMenuMobile = function () {
    $(".nav-mobile-button").on('click', function () {
      $(".main-navigation-mobile").toggleClass("expand");
    });
  };
  toggleMenuMobile();
});
