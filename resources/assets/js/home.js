$(".home", function() {

    let $eventsQtd = $('.media-element').length;
    let $eventWidth = $('.media-element').width();
    let $windowSize = $(window).width();
    let $gapValue = parseInt($('.media-scroller').css("gap"));
    let sizeToCenter = $eventWidth * $eventsQtd + $gapValue * $eventsQtd;

    $(window).width() > sizeToCenter ? $(".media-scroller").addClass("justify-content-center") : $(".media-scroller").removeClass("justify-content-center")

    $(window).on("resize", function() {

        console.log(sizeToCenter);

        $(window).width() > sizeToCenter ? $(".media-scroller").addClass("justify-content-center") : $(".media-scroller").removeClass("justify-content-center")

    });

});
