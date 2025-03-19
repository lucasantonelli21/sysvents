$(".home").each(function() {

    let $eventsQtd = $('.media-element').length;
    let $eventWidth = $('.media-element').width();
    let $windowSize = $(window).width();
    let $gapValue = parseInt($('.media-scroller').css("gap"));
    let sizeToCenter = $eventWidth * $eventsQtd + $gapValue * $eventsQtd;

    $(window).width() > sizeToCenter ? $(".media-scroller").addClass("justify-content-center") : $(".media-scroller").removeClass("justify-content-center")

    $(window).on("resize", function() {

        $(window).width() > sizeToCenter ? $(".media-scroller").addClass("justify-content-center") : $(".media-scroller").removeClass("justify-content-center")

    });

    $(".media-element").on("click", function() {
        window.location.href = getUrl('/eventos/'+$(this).data("id"));
    })

    $(".library-button").on("click", function () {
        window.location.href = getUrl('/eventos');
    })

});
