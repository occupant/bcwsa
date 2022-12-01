(function ($) {

  // All your code here
  $(document).ready(function() {
    //start document ready
    
    // toggle navigation on click
    $('#navigation .content').hide();
    $('#navigation h2').click(function() {
      $('#navigation .content').toggle('fast');
      return false;
    });
    
    // add active-hover class on hover
    $("#navigation li ul").on("hover", function(){
        $(this).prev().toggleClass('active-hover');
    });
    
    // toggle search on click
    /*$('#block-search-form').hide();
    $('.utility .search-link').click(function() {
      $('#block-search-form').toggle('fast');
      return false;
    });*/
    

    
    
    // Modify the youtube embeded styles and add a wrapper so that it is responsive.
    $("#content .field-name-body iframe, #content .field-name-field-video iframe").wrap('<p class="media_embed" >').removeAttr('width').removeAttr('height');
    
    $("#block-views-frontpage-block-4 > h2").append(' <i class="icon-comments-alt icon-large"></i>');
  //end document ready
  });
  

  
  $(window).load(function() {
    //start window load
  
    // default slider
    $('#block-system-main .flexslider').flexslider({
        animation: "slide"
    });
    
    // sponsors sliders
    /*$('.flexslider.sponsors').flexslider({
      animation: "slide",
      animationLoop: true,
      //itemWidth: auto,
      itemMargin: 5,
      //minItems: 1, // use function to pull in initial value
      //maxItems: 3, // use function to pull in initial value
      controlNav: false
    });
    $('.flexslider.network').flexslider({
      animation: "slide",
      animationLoop: true,
      itemWidth: 190,
      itemMargin: 5,
      minItems: 2, // use function to pull in initial value
      maxItems: 4, // use function to pull in initial value
      controlNav: false
    });*/
    
    //$('.flexslider.sponsors .flex-viewport').wrapInner("<div class='inner'></div>")
    //end window load
  });
  
    
})(jQuery);