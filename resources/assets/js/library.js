$(".library").each(function() {

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

    //Diminui width de library-container se sobrar espaço à direita não preenchido por um evento
    function centralizeLibrary() {
        let $libraryContainer = $(".library-container");
        $libraryContainer.css("width", "100%");
        let totalWidth = parseInt($libraryContainer.width())+16; //+16 desconsidera o padding

        //Cada media-element ocupa 225+16de gap, que é 241, com exceção do último que não tem gap e ocupa 225
        let remainingSpace = (totalWidth % 241)+16;
        $libraryContainer.css("width", totalWidth-remainingSpace+"px");

    }
    centralizeLibrary();

    $( window ).on( "resize", function() {
        centralizeLibrary();
    });

    $( ".name-search" ).on( "keyup", function() {
        search();
    });

    $( ".categories-container" ).on( "change", function() {
        search();
    });

    $(".media-element").on("click", function() {
        window.location.href = getUrl('/'+$(this).data("id"));
    })

});