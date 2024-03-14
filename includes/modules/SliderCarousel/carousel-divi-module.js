jQuery(document).on('ready', function(){
    jQuery('.robiul_slider_carousel_main').slick({
      dots: false,
      arrows: true,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
      asNavFor: '.robiul_slider_thumb'
    });    
    
    jQuery('.robiul_slider_thumb').slick({
      dots: false,
      arrows: false,
      infinite: false,
      speed: 300,
      slidesToShow: 6,
      slidesToScroll: 1,
      asNavFor: '.robiul_slider_carousel_main',
      spaceBetween: 20,
      centeredSlides: true,
      focusOnSelect: true,
      responsive: [
        {
          breakpoint: 1140,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
});