$(document).ready(function () {
  if ($(".list-posts-container .list-posts-wrapper .list-posts.slick").length > 0) {
    $(".list-posts-container .list-posts-wrapper .list-posts.slick").slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3,
      responsive: [
        {
          breakpoint: 920,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
          },
        },
        {
          breakpoint: 480,
          settings: {
            vertical: true,
            verticalSwiping: true,
            slidesToShow: 3,
            slidesToScroll: 3,
          },
        },
        {
          breakpoint: 320,
          settings: {
            vertical: true,
            verticalSwiping: true,
            slidesToShow: 3,
            slidesToScroll: 3,
          },
        },
      ],
    });
  }
});