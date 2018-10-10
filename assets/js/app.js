


import M from 'materialize-css/dist/js/materialize.min.js'



const $ = require('jquery');
global.$ = global.jQuery = $;

$( document ).ready(function(){
    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        hover: true, // Activate on hover
        coverTrigger: false, // Displays dropdown below the button
        alignment: 'right' // Displays dropdown with edge aligned to the left of button
      }
    );
    $('.dropdown-button-mobile').dropdown({
        inDuration: 300,
        outDuration: 225,
        hover: true, // Activate on hover
        coverTrigger: false, // Displays dropdown below the button
        alignment: 'right' // Displays dropdown with edge aligned to the left of button
      }
    );

    $(window).scroll(function(){
        if($(window).scrollTop()>0){
            $('nav').removeClass('grey darken-3');
            $('nav').addClass('grey darken-1 sticky-nav', 2000, 'fade');
        }else{
            $('nav').addClass('grey darken-3')
            $('nav').removeClass('sticky-nav', 2000, 'fade');
        }

    });

    $('.sidenav').sidenav();

    $('.modal').modal();

    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true,
 }, setTimeout(autoplay, 4500));

 function autoplay() {
   $('.carousel').carousel('next');
   setTimeout(autoplay, 6500);
 }


});