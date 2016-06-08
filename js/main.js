$(document).ready(function()
                        {
                            $('#container').mousewheel(function(event) {
    console.log(event.deltaX, event.deltaY, event.deltaFactor);
});
                        });
    
    
    
    
    
//    var $horizontal = $('#content');
//
//    $(document).scroll(function () {console.log('caciu');
//        var s = $(this).scrollTop(),
//            d = $(document).height(),
//            c = $(this).height();
//
//        scrollPercent = (s / (d - c));
//
//        var position = (scrollPercent * ($(document).width() - $horizontal.width()));
//        
//        $horizontal.css({
//            'left': position
//        });
//    });
