$(".event-Form").each(function () {
    var $page = $(this);
    var $cepInput = $page.find("#cep");
    $cepInput.mask("00000-000");

    if($page.find("#latitude").val() !== "" && $page.find('#longitude').val() !== "") {
        var lat = $page.find("#latitude").val();
        var lon = $page.find("#longitude").val();
        var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`;
        console.log(url);
        fetch(url)
        .then(response => response.json())
        .then(data => {
            $page.find("#cep").val(data.address.postcode);
            $page.find("#address").val(data.address.road);
            $page.find("#neighbourhood").val(data.address.suburb);
            $page.find("#city").val(data.address.city);
            $page.find("#state").val(data.address.state);
        })
        .catch(error => console.error('Erro ao buscar endereço:', error));

    }



    $cepInput.on("keyup", () => {
        var cep = $cepInput.cleanVal();

        if (cep.length !== 8) {
            return;
        }

        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/", (data) => {
            if (data.erro) {
                console.log("oi");
            }
            $page.find("#address").val(data.logradouro);
            $page.find("#neighbourhood").val(data.bairro);
            $page.find("#city").val(data.localidade);
            $page.find("#state").val(data.uf);
            var combinedAddress =
            $page.find("#address").val() +
            ", " +
            $page.find("#neighbourhood").val() +
            ", " +
            $page.find("#city").val() +
            ", " +
            $page.find("#state").val();

        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(
            combinedAddress
        )}`;


        fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                $page.find('#latitude').val(data[0].lat);
                $page.find('#longitude').val(data[0].lon);
            } else {
                console.log('deu erro');
            }
        })
        .catch(error => console.error('Erro ao buscar coordenadas:', error));


        });
    });

});
