
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
    $(window).scroll(function(){
        if($(window).scrollTop()>100){
            $('nav').addClass('sticky-nav');
        }else{
            $('nav').removeClass('sticky-nav');
        }
    });

});