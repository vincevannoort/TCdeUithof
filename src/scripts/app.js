import $ from 'jquery';
import 'slick-carousel';

/** when page is ready */
$(document).ready(function () {
  /** sliders */
  $('.tc-slider').slick({ dots: true,  arrows: false, autoplay: true, speed: 750, autoplaySpeed: 2500, fade: true, adaptiveHeight: true, dotsClass: 'tc-slider-dots container' });
  $('.tc-partners').slick({ variableWidth: true, arrows: false, autoplay: true, speed: 750, autoplaySpeed: 2500 });

  /** menu toggle */
  var menuButton = document.querySelector('.tc-header__links__mobile__open')
  var menu = document.querySelector('.tc-header__links')
  var header = document.querySelector('.tc-header')
  menuButton.addEventListener('click', function (event) {
    event.preventDefault();
    this.classList.toggle('tc-header__links__mobile__open--mobile-active')
    menu.classList.toggle('tc-header__links--mobile-active')
    header.classList.toggle('tc-header--mobile-active')
  })

  // var menuItems = document.querySelector('.tc-header__links .menu > li');
});