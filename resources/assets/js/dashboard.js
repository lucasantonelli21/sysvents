$(".page-dashboard", function () {
    var $page = $(this);
    var $events = $page.find(".events");
    var $eventsChart = $page.find("#event-chart");
    var $ticketsChart = $page.find("#tickets-chart");
    if ($eventsChart.length === 0) {
        console.error("Elemento #event-chart não encontrado.");
        return;
    }

    var eventsData = $events.data("events");
    if (!eventsData || eventsData.length === 0) {
        console.error("Dados de eventos não encontrados ou estão vazios.");
        return;
    }

    var eventsNames = [];
    var eventsTickets = [];
    var eventsProfit = [];
    eventsData.forEach((element) => {
        eventsNames.push(element.event_name);
        eventsTickets.push(element.total_tickets);
        eventsProfit.push(element.total_revenue);
    });
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
                    // backgroundColor: [
                    //     "rgba(255, 99, 132, 0.2)",
                    //     "rgba(255, 159, 64, 0.2)",
                    //     "rgba(255, 205, 86, 0.2)",
                    //     "rgba(75, 192, 192, 0.2)",
                    //     "rgba(54, 162, 235, 0.2)",
                    //     "rgba(153, 102, 255, 0.2)",
                    //     "rgba(201, 203, 207, 0.2)",
                    // ],
                    // borderColor: [
                    //     "rgb(255, 99, 132)",
                    //     "rgb(255, 159, 64)",
                    //     "rgb(255, 205, 86)",
                    //     "rgb(75, 192, 192)",
                    //     "rgb(54, 162, 235)",
                    //     "rgb(153, 102, 255)",
                    //     "rgb(201, 203, 207)",
                    // ],
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
                            weight: 'bold'
                          }
                        }
                    },
                    color: 'white',
                    formatter: (value, context) => {
                        return  value;
                    }
                }
            }
        },
    });

    var ticketsChart = new Chart($ticketsChart,{
        type: "bar",
        data: {
            labels: eventsNames,
            datasets: [
                {
                    label: `Lucro de cada Evento`,
                    data: eventsProfit,
                    borderWidth: 1,
                    backgroundColor: [
                        "rgb(255, 99, 132)",
                        "rgb(255, 159, 64)",
                        "rgb(255, 205, 86)",
                        "rgb(75, 192, 192)",
                        "rgb(54, 162, 235)",
                        "rgb(153, 102, 255)",
                    ],
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
                            weight: 'bold'
                          }
                        }
                    },
                    color: 'white',
                    formatter: (value, context) => {
                        return "$" + value;
                    }
                }
            }
        },
    });
});
