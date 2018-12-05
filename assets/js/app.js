
import M from 'materialize-css/dist/js/materialize.min.js'
const routes = require('../../public/js/fos_js_routes.json');
import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

Routing.setRoutingData(routes);
require('webpack-jquery-ui/draggable');


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

$( ".delete-image" ).each(function(){

    $(this).on("click",function() {

        var id = $(this).attr('id');
        var $tr = $(this).closest('tr');
        var $card = $(this).closest('deleteCard');
        $.ajax({
            url: "delete-image",
            type: "POST",
            data: {id: id },
            success: function(){
                $tr.find('td').fadeOut(1000,function(){ 
                $tr.remove();
            });
                $card.find('deleteCard').fadeOut(1000,function(){ 
                $card.remove();
                             
                }); 
            },
            beforeSend: function(){
                return confirm("Etes vous sur de vouloir supprimer l'image' ?")
            },
            complete: function(){
                M.toast({html: 'image supprimé', classes: 'rounded'});
            }
        });
});
        
});

$( ".download_image" ).each(function(){

    $(this).on("click",function() {

        var id = $(this).attr('id');
        $.ajax({
            url: "download",
            type: "POST",
            data: {id: id },
            success: function(){
                M.toast({html: 'Image téléchargée', classes: 'rounded'});
            },
            error: function(){
                M.toast({html: 'Image non trouvé dans la base', classes: 'rounded'});
            },
            beforeSend: function(){
                return confirm("Voulez vous télécharger cette photo ?")
            },
            complete: function(){
                
            }
        });
});
        
});

  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    var i = '';
    var id = $(this).parent().attr('data-star');
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
     starSave(onStar, id);
    
  });
  

function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");
}

function starSave(ratingValue, id){
    $.ajax({
        url: "star",
        type: "POST",
        data: {ratingValue: ratingValue, id: id },
        success: function(){  
            if (ratingValue <= 2){
           M.toast({html: ratingValue + ' étoile(s) !! l\'image ne vous plait pas ? <button onclick="location.href=\'avis/'+ id +'\'" class="btn-flat toast-action">Donner mon Avis</button>'})
          }else{
            M.toast({html: ratingValue + ' étoile(s) !! Merci d\'avoir voté'}) 
          }
        }
});
}

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
$('.fixed-action-btn').floatingActionButton({
    direction:'left'
});


});