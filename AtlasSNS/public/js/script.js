
$(function() {


  //アコーディオン
//   $('.nav-open').click(function(){
//     $(this).toggleClass('active');
//     $(this).next('ul').slideToggle();
// });

$('.AtlasAccordion').on('click', function(e) {
    e.preventDefault();

    $('.AtlasAccordion').toggleClass('is-active');
    $('.AtlasAccordion-ul').toggleClass('is-active');

    return false;
  });



});