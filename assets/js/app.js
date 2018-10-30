
import M from 'materialize-css/dist/js/materialize.min.js'
const routes = require('../../public/js/fos_js_routes.json');
import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

Routing.setRoutingData(routes);


const $ = require('jquery');
global.$ = global.jQuery = $;

$(document).ready(function(){

    // delete post in ajax

    var id = $( ".delete-entries" ).attr('id');
    

    $( ".delete-entries" ).each(function(){

    $(this).on("click",function() {

        var id = $(this).attr('id');
        var $tr = $(this).closest('tr');
        $.ajax({
            url: "delete-entry",
            type: "POST",
            data: {id: id },
            success: function(){
                $tr.find('td').fadeOut(1000,function(){ 
                $tr.remove();
                             
                }); 
            },
            beforeSend: function(){
                return confirm("Etes vous sur de vouloir supprimer le post ?")
            },
            complete: function(){
                M.toast({html: 'Post supprimé', classes: 'rounded'});
            }
        });
});
        
});

    // fin delete Post ajax

    $('.tooltipped').tooltip();

    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        hover: true, // Activate on hover
        coverTrigger: false, // Displays dropdown below the button
        alignment: 'right' // Displays dropdown with edge aligned to the left of button
      });

    $('.dropdown-button-mobile').dropdown({
        inDuration: 300,
        outDuration: 225,
        hover: true, // Activate on hover
        coverTrigger: false, // Displays dropdown below the button
        alignment: 'right' // Displays dropdown with edge aligned to the left of button
      });


    $(window).scroll(function(){
        if($(window).scrollTop()>0){
            $('nav').removeClass('grey darken-3');
            $('nav').addClass('grey darken-1 sticky-nav', 2000, 'fade');
        }else{
            $('nav').addClass('grey darken-3')
            $('nav').removeClass('sticky-nav', 2000, 'fade');
        }});

    $('.sidenav').sidenav();

    $('.modal').modal();

$('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true,
 }, setTimeout(autoplay, 4500));

 function autoplay() {
   $('.carousel').carousel('next');
   setTimeout(autoplay, 10000);
 }
M.updateTextFields();

});