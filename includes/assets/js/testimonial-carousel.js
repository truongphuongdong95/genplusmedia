(function ($) {
  var initSliderTestimonial = function () {
    if ( $(".testimonial-carousel-container .list-testimonial.slick").length <= 0) return;
    
    $(".testimonial-carousel-container .list-testimonial.slick").slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3,
      responsive: [
        {
          breakpoint: 1000,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  };
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/global",
      initSliderTestimonial
    );
  });
})(jQuery);