(function ($) {
  // All your code here  
  $(document).ready(function() {
 
    // Homepage slideshow
    $('.homeslideshow').cycle({
      fx: 'scrollLeft', 
      speed: 600, 
      timeout: 6000,
      pause: true
    });
    $('#workslideshow').cycle({ 
      fx: 'fade', 
      speed: 'fast', 
      timeout: 6000, 
      next: '#next', 
      prev: '#prev' 
    });
    
    //Modal Window
    //select all the a tags with name equal to modal
    $('a[name=modal]').click(function(e) {
      //Cancel the link behavior
      e.preventDefault();
      //Get the A tag
      var id = $(this).attr('href');
      //Get the screen height and width
      var maskHeight = $(document).height();
      var maskWidth = $(window).width();
      //Set heigth and width to mask to fill up the whole screen
      $('#mask').css({'width':maskWidth,'height':maskHeight});
      //transition effect		
      $('#mask').fadeIn(100);	
      $('#mask').fadeTo("fast",0.8);	
      //Get the window height and width
      var winH = $(window).height();
      var winW = $(window).width();
      //Set the popup window to center
      $(id).css('top',  winH/2-$(id).height()/2);
      $(id).css('left', winW/2-$(id).width()/2);
      //transition effect
      $(id).fadeIn(100); 
    });
    //if close button is clicked
    $('.window .close').click(function (e) {
      //Cancel the link behavior
      e.preventDefault();
      $('#mask').hide();
      $('.window').hide();
    });
    //if mask is clicked
    $('#mask').click(function () {
      $(this).hide();
      $('.window').hide();
    });

    //Tooltips
    var tip;
    $(".tooltip").hover(function(){
      //Caching the tooltip and removing it from container; then appending it to the body
      tip = $(this).find('.tip').remove();
      $('body').append(tip);
      tip.fadeIn('fast'); //Show tooltip
    }, function() {
      tip.hide().remove(); //Hide and remove tooltip appended to the body
      $(this).append(tip); //Return the tooltip to its original position
    }).mousemove(function(e) {
      //console.log(e.pageX)
      var mousex = e.pageX + 20; //Get X coodrinates
      var mousey = e.pageY + 30; //Get Y coordinates
      var tipWidth = tip.width(); //Find width of tooltip
      var tipHeight = tip.height(); //Find height of tooltip
      //Distance of element from the right edge of viewport
      var tipVisX = $(window).width() - (mousex + tipWidth);
      var tipVisY = $(window).height() - (mousey + tipHeight);
      if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport
        mousex = e.pageX - tipWidth - 20;
        $(this).find('.tip').css({  top: mousey, left: mousex });
        } if ( tipVisY < 30 ) { //If tooltip exceeds the Y coordinate of viewport
          mousey = e.pageY - tipHeight - 30;
          tip.css({  top: mousey, left: mousex });
        } else {
          tip.css({  top: mousey, left: mousex });
        }
      });                                  
    });

})(jQuery);