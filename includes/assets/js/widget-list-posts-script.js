$(document).ready(function () {
  if ($(".list-posts-container .list-posts-wrapper .list-posts.slick").length > 0) {
    $(".list-posts-container .list-posts-wrapper .list-posts.slick").slick({
      infinite: false,
      slidesToShow: 3,
      slidesToScroll: 3,
      arrows:false,
      responsive: [
        {
          breakpoint: 920,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: false,
          },
        },
        {
          breakpoint: 480,
          settings: {
            arrows:false,
            slidesToShow: 2,
            slidesToScroll: 2,
            vertical: true,
            verticalSwiping: false,
            swipeToSlide: false,
          },
        },
      ],
    });
  }
});