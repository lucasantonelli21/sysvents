$(".page-dashboard").each(function () {
    var $page = $(this);
    var $selectEvents = $page.find("#select2-events");
    var $eventsName = $page.find(".events-name");
    var eventsName = $eventsName.data("events-name");
    $selectEvents.select2({
        width: "100%",
        placeholder: "Insira o nome do evento",
        dropdownParent: $(".modal"),
        // dropdownCssClass: "drop-down-select",
        // selectionCssClass: ":all:",S
        theme: "classic",
        language: {
            noResults: function () {
                return "Não foram encontrados eventos com este nome ! ";
            },
        },
        ajax: {
            url: "http://127.0.0.1:8000/painel/eventos/nomes",
            delay: 200,
            data: function (params) {
                var query = {
                    search: params.term,
                    type: "public",
                };
                return query;
            },
            processResults: function (data) {
                return { results: data };
            },
        },
    });
    var $events = $page.find(".events");
    var $eventsChart = $page.find("#event-chart");
    var $ticketsChart = $page.find("#tickets-chart");

    var eventsData = $events.data("events");

    var eventsNames = [];
    var eventsTickets = [];
    var eventsProfit = [];
    if($eventsName.length > 0){
    }
    eventsData.forEach((element) => {
        eventsNames.push(element.event_name);
        eventsTickets.push(element.total_tickets);
        eventsProfit.push(element.total_revenue);
    });


    var backgroundColors = [
        "rgb(255, 99, 132)",
        "rgb(255, 159, 64)",
        "rgb(255, 205, 86)",
        "rgb(75, 192, 192)",
        "rgb(54, 162, 235)",
        "rgb(153, 102, 255)",
    ];

    Chart.register(ChartDataLabels);

    var eventChart = new Chart($eventsChart, {
        type: "pie",
        data: {
            labels: eventsNames,
            datasets: [
                {
                    label: `Número de Ingressos vendidos`,
                    data: eventsTickets,
                    //borderWidth: 1,
                    backgroundColor: backgroundColors,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                datalabels: {
                    labels: {
                        title: {
                            font: {
                                weight: "bold",
                            },
                        },
                    },
                    color: "white",
                    formatter: (value, context) => {
                        return value;
                    },
                },
            },
        },
    });

    var ticketsChart = new Chart($ticketsChart, {
        type: "bar",
        data: {
            datasets: eventsNames.map((name, index) => ({
                label: name,
                data: [{ x: index, y: eventsProfit[index] }],
                backgroundColor: backgroundColors[index > 5 ? index % 5 : index],
                xAxisID: "x1",
                yAxisID: "y",
            })),
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        color: "white",
                        display: true,
                        text: "Número de Vendas",
                    },
                },
                x: {
                    labels: eventsNames,
                    title: {
                        color: "white",
                        display: true,
                        text: "Eventos",
                    }
                },
                x1: {
                    display: false,
                    offset: true
                },
            },
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                    labels: {
                        boxHeight: 5,
                        color: "white",
                    },
                },
                datalabels: {
                    anchor: "center",
                    align: "top",
                    labels: {
                        title: {
                            font: {
                                weight: "bold",
                            },
                        },
                    },
                    color: "white",
                    formatter: (value, context) => {
                        return "$" + value.y;
                    },
                }
            }
        },
    });


});
