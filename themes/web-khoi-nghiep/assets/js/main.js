(function($){
    $(document).ready(function(){
        if( $(window).width() > 600 && $(".hps_tooltip_box").length > 0  ){

            var thewidth =  $(window).width();
            var theheight =  $(window).height();
            $(".hps_tooltip_box").hover(function() {
                $(this).mousemove(function(e)
                {             var theX = thewidth - e.clientX ;
                    var theY = theheight - e.clientY ;
                    if (theX > 520 ) {
                        theX = e.clientX;
                    } else {
                        theX = thewidth - 520;
                    }
                    if (theY > $(this).children('.hps_tooltip').height()) {
                        theY = e.clientY;
                    } else {
                        theY = theheight - $(this).children('.hps_tooltip').height() - 30;
                    }

                    $(this).children('.hps_tooltip').css('left', theX + 10 ).css('top', theY + 10 ).css('display', 'block');
                });
            }, function() {
                $(this).children('.hps_tooltip').css('display', 'none');
            });

        }//check

    });//dom ready
})(jQuery);