$(".page-maps", function () {
    var $page = $(this);
    const $mapEl = $page.find(".map");
    var $events = $page.find(".events");
    var eventsData = $events.data("events");

    if ($mapEl.length > 0) {

        const map = new google.maps.Map($mapEl[0], {
            center: { lat: eventsData.latitude*1, lng: eventsData.longitude*1 },
            zoom: 18,
        });

        map.markers = [];

        const marker = new google.maps.Marker({
            position: { lat: eventsData.latitude*1, lng: eventsData.longitude*1},
            map: map,
            title: 'Estou Aqui',
        });

        map.markers.push(marker);

    }

});


