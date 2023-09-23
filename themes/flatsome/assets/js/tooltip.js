

	jQuery(document).ready(function($) {
  
	var $parent,
		windowWidth,
		windowHeight;
	  
	//get actual window size
	function winSize() {
		windowWidth = $(window).width(),
			windowHeight = $(window).height();
	}
	winSize();
	$(window).resize(winSize);
	//tooltip fadeIn and fadeOut on hover  
	$('.tooltip').each(function() {
	   
		$(this).parent().hover(function() {
		  $(this).find('.tooltip').fadeIn('fast');
		}, function() {
		   $(this).find('.tooltip').fadeOut('fast');
		});
	 
	});
  
  
	//tooltip position
	$(document).mousemove(function(e) {
		var mouseY = e.clientY,
			mouseX = e.clientX,
			tooltipHeight,
			tooltipWidth;
		
		$('.tooltip').each(function() {
		    var $tooltip = $(this);
		    tooltipHeight = $tooltip.outerHeight();
		    tooltipWidth = $tooltip.width();
		    $parent = $tooltip.parent();
		 
		    $tooltip.css({
			    'left':mouseX+0,
			    'top':mouseY+20
		    });
		  
		    //reposition
		    if (tooltipWidth + mouseX+ 20> windowWidth) {
		        $tooltip.css({
			        'left':mouseX-tooltipWidth-20
		        });
		    }
		
		    if (tooltipHeight + mouseY +20 > windowHeight) {
			    $tooltip.css({
			        'top':mouseY-20-tooltipHeight
		        }); 
		    }
		});
	});
});//end ready