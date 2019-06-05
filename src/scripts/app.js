import $ from 'jquery';
import 'slick-carousel';

/** when page is ready */
$(document).ready(function () {
  $('.tc-slider').slick({
    dots: true, 
    arrows: false,
    // draggable: false,
    autoplay: true,
    speed: 750,
    autoplaySpeed: 2500,
    fade: true,
    adaptiveHeight: true,
    dotsClass: 'tc-slider-dots container'
  });

  $('.tc-partners').slick({
    variableWidth: true,
    arrows: false,
    autoplay: true,
    speed: 750,
    autoplaySpeed: 2500,
    // dots: true,
    // draggable: false,
    // fade: true,
    // dotsClass: 'tc-slider-dots container'
  });
});