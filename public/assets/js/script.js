$(document).ready(function(){
  $('.nav-burger').click(function(){
    $('.nav-links').toggleClass('responsive');
  });

  $('.down-link').hover(function(){
    $('.nav-sublinks', this).toggleClass('responsive');
  });


  $(window).scroll(function(){
    if ($(this).scrollTop() > 20) {
      $('.nav-bar').addClass('scroll');
    }
    else {
      $('.nav-bar').removeClass('scroll');
    }
  });

  $('.emoji-picker').hide();
  $('.emoji-trigger').click(function(){
    $('.emoji-picker').toggle();
  });
  $('.emoji').click(function(){
    $('.inputbox').val($('.inputbox').val() + $(this).text());
  });

  $('.btn').click(function(){
    $(this).text('en cours');
  });
});
