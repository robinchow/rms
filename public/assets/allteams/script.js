$("a[href^='#']").on('click', function(e) {

   // prevent default anchor click behavior
   e.preventDefault();

   // store hash
   var hash = this.hash;

   // animate
   $('html, body').animate({
       scrollTop: $(this.hash).offset().top
     }, 300, function(){

       // when done, add hash to url
       // (default click behaviour)
       window.location.hash = hash;
     });

});

$(document).ready(function () {
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]'
    });
});


$("#tooltip").attr({
    "data-placement": "top",
    "data-toggle": "tooltip",
    "data-original-title": "Come back in September"
});

$('.page .container p, .page .container h1, .page .container ul li').addClass('lead');

