jQuery(document).on('ready', function(){
    var mainSetting = JSON.parse(jQuery('.robiul_slider_carousel_main').attr('data-settings'));
    var thumbSetting = JSON.parse(jQuery('.robiul_slider_thumb').attr('data-settings'));

    console.log(thumbSetting);

    jQuery('.robiul_slider_carousel_main').slick({
      dots: false,
      arrows: mainSetting.arrows,
      autoplay: mainSetting.autoplay,
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
      slidesToShow: thumbSetting.slidesToShow,
      slidesToScroll: 1,
      asNavFor: '.robiul_slider_carousel_main',
      spaceBetween: 20,
      centeredSlides: true,
      focusOnSelect: true,
      responsive: thumbSetting.responsive
    });
});