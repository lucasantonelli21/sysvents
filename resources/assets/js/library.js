$(".library", function() {

    const url = getUrl('/filtrar');
    const successCallback = function(data) {
        $(".evento").addClass("d-none");

        for(let i = 0; i < data.events.length; i++) {
            $("#evento"+data.events[i].id).removeClass("d-none");
        }
    }
    const errorCallback = function() {
        console.log("Erro");
    }

    function search() {
        let name = $( ".name-search" ).val();
        let themes = [];
        let $themes = $('input[name=theme]:checked');

        for(let i = 0; i < $themes.length; i++) {
            themes.push($themes[i].attributes.id.value);
        }

        let data = {
            "name": name,
            "themes": themes
        };

        console.log(data);

        $.ajax({
            method: "GET",
            url: url,
            success: successCallback,
            error: errorCallback,
            data: data
        })
    }

    $( ".name-search" ).on( "keyup", function() {
        search();
    });

    $( ".categories-container" ).on( "change", function() {
        search();
    });


});