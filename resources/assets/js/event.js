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

    //Atualiza a quantidade total e valor total, de acordo com os valores colocados nos inputs de quantidade de cada ingresso
    function updateFields() {
        let ticket_amount = 0;
        let total_value = 0;
        let ticket_type_id;
        $(".amount-input").each(function() {
            ticket_type_id = $(this).data("ticket-type-id");
            ticket_amount += parseInt($(this).val());
            total_value += parseInt($(this).val())*parseFloat($(".price-"+ticket_type_id).text());
        });

        console.log(total_value)

        $(".tickets-total-price").text(total_value);
        $(".tickets-total-amount").text(ticket_amount);
    }

    $(".amount-input").on("change", function() {
        updateFields();
    });

});
