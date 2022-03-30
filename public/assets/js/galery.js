$(document).ready(function(){
  $('.image').click(function(){
    $('#expandedImg').attr('src', $(this).attr('src'));
    $('#imgtext').html($(this).attr('alt'));
    $('#expandedImg').parent().show();
  });

  $('.container').click(function(){
    $(this).hide();
  });
});
