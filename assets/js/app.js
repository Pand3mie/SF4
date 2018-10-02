
import M from 'materialize-css/dist/js/materialize.min.js'

const $ = require('jquery');
global.$ = global.jQuery = $;

$( document ).ready(function(){
$(".dropdown-trigger").dropdown();
});