$(".event-Form").each(function () {
    var $page = $(this);
    var $cepInput = $page.find("#cep");
    $cepInput.mask("00000-000");

    var $lat = $page.find("#latitude");
    var $long = $page.find("#longitude");
    const $mapEl = $page.find(".map");

    var map = null;
    if ($lat && $long) {
        map = new google.maps.Map($mapEl[0], {
            center: {
                lat: $lat.val() * 1 ? $lat.val() * 1 : -23.5505199,
                lng: $long.val() * 1 ? $long.val() * 1 : -46.6333094,
            },
            zoom: 18,
        });

        map.markers = [];

        const marker = new google.maps.Marker({
            position: {
                lat: $lat.val() * 1 ? $lat.val() * 1 : -23.5505199,
                lng: $long.val() * 1 ? $long.val() * 1 : -46.6333094,
            },
            map: map,
            title: "Evento",
        });

        map.markers.push(marker);
    }

    $cepInput.on("keyup", () => {
        console.log("oi");
        var cep = $cepInput.cleanVal();

        if (cep.length !== 8) {
            return;
        }

        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/", (data) => {
            if (data.erro) {
                console.log("oi");
            }
            $page.find("#address").val(data.logradouro);
            $page.find("#neighborhood").val(data.bairro);
            $page.find("#city").val(data.localidade);
            $page.find("#state").val(data.uf);
            var complemento = $page.find("#complement").val() || ""; // se houver um campo de complemento
            var combinedAddress =
                $page.find("#address").val() +
                ", " +
                $page.find("#neighborhood").val() +
                ", " +
                $page.find("#city").val() +
                ", " +
                $page.find("#state").val() +
                (complemento ? ", " + complemento : "");

            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(
                combinedAddress
            )}`;

            fetch(url)
                .then((response) => response.json())
                .then((data) => {
                    if (data.length > 0) {
                        $page.find("#latitude").val(data[0].lat);
                        $page.find("#longitude").val(data[0].lon);
                        map.setCenter({
                            lat: $lat.val() * 1,
                            lng: $long.val() * 1,
                        });
                        map.markers[0].setPosition({
                            lat: $lat.val() * 1,
                            lng: $long.val() * 1,
                        });
                    } else {
                        console.log("deu erro");
                    }
                })
                .catch((error) =>
                    console.error("Erro ao buscar coordenadas:", error)
                );
        });
    });

    map.addListener("click", (e) => {
        $lat.val(e.latLng.lat());
        $long.val(e.latLng.lng());
        map.markers[0].setPosition({
            lat: $lat.val() * 1,
            lng: $long.val() * 1,
        });

        var addressLatLong = $lat.val() + "," + $long.val();
        var urlLatLong = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(
            addressLatLong
        )}`;
        fetch(urlLatLong)
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    const info = data[0];
                    const displayName = info.display_name || "";
                    const parts = displayName.split(",");
                    console.log(parts);
                    $page.find("#cep").val(parts[7].length > 9 ? parts[8] : parts[7]);
                    $page.find("#address").val(parts[0]);
                    $page.find("#neighborhood").val(parts[1]);
                    $page.find("#city").val(parts[2]);
                    var uf = getUF(parts[5].length > 19 ? parts[6] : parts[5]);
                    $page.find("#state").val(uf);
                } else {
                    console.log("Nenhum resultado retornado pelo Nominatim.");
                }
            })
            .catch((error) =>
                console.error("Erro ao buscar endereço:", error)
            );
    });
});
