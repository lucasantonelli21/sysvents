$(".event").each(function() {

    const title = $(".event-title").text();
    const start_date = $(".event-date").val() + '';
    const date = start_date.substring(0, 4)+start_date.substring(5, 7)+start_date.substring(8, 10);
    let description = $(".event-description").text();
    description = description.replaceAll(' ', '+');

    const url = "https://www.google.com/calendar/render?action=TEMPLATE&text="+title+"&dates="+date+"/"+date+"&details="+description+"&sf=true&output=xml";

    $(".schedule-button").on("click", function() {
        window. open(url, '_blank')
    })



});