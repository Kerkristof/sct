$(document).ready(function(){
  $('.nav-burger').click(function(){
    $('.nav-links').toggleClass('responsive');
  });
  $(window).scroll(function(){
    if ($(this).scrollTop() > 20) {
      $('.nav-bar').addClass('scroll');
    }
    else {
      $('.nav-bar').removeClass('scroll');
    }
  });

});
