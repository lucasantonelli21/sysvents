$(".page-maps").each(function () {
    var $page = $(this);
    const $mapEl = $page.find(".map");
    var $events = $page.find(".events");
    var eventsData = $events.data("events");

    if ($mapEl.length > 0) {
        const map = new google.maps.Map($mapEl[0], {
            center: {
                lat: eventsData.latitude * 1,
                lng: eventsData.longitude * 1,
            },
            zoom: 18,
        });

        map.markers = [];

        const marker = new google.maps.Marker({
            position: {
                lat: eventsData.latitude * 1,
                lng: eventsData.longitude * 1,
            },
            map: map,
            title: "Local do Evento",
        });

        map.markers.push(marker);
    }

    var $btnOpenLoc = $page.find(".btn-open-location");
    $btnOpenLoc.on("click", function () {
        const destination = `${eventsData.address},${eventsData.address_number}, ${eventsData.city}, ${eventsData.state}`;
        const url = `https://www.google.com/maps/dir/?api=1&destination=${encodeURIComponent(
            destination
        )}`;
        window.open(url, "_blank");
    });
});
