$(".library", function() {

    const url = getUrl('/filtrar');
    const successCallback = function(data) {
        $(".evento").addClass("d-none");

        for(let i = 0; i < data.events.length; i++) {
            $("#evento"+data.events[i].id).removeClass("d-none");
        }
        console.log("Sucesso");
    }
    const errorCallback = function() {
        console.log("Erro");
    }

    $( ".filter" ).on( "keyup", function() {

        let name = $( ".filter" ).val();

        let data = {
            "name": name
        };

        console.log(data);

        $.ajax({
            method: "GET",
            url: url,
            success: successCallback,
            error: errorCallback,
            dataType: "json",
            data: data
        })
    });



});