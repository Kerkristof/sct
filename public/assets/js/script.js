$(document).ready(function(){
  $('.nav-burger').click(function(){
    $('.nav-links').toggleClass('responsive');
  });

  $('.down-link').hover(function(){
    $('.nav-sublinks', this).toggleClass('responsive');
  });

  // ICI LE CODE DU CAROUSSEL
  setInterval(function(){
    let carouselWidth = $('.slideshow').width();
    $('.slideshow img:first').animate({marginLeft:-carouselWidth}, 800,function(){
      $('.slideshow img:last').after($(this).css({marginLeft:0}));
    });
  },3500);

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
