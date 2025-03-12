<x-blank>
    <div class="page-dashboard">
        <h1 class="title text-center">DashBoard para Administradores</h1>
        <div class="events d-none" data-events="{{ $events }}"></div>
        <div class="canvas-row">
            <div class="card-events">
                <h2 class="text-center">Número de Ingressos comprados por Evento</h2>
                <div class="canvas-wrapper">
                    <canvas id="event-chart"></canvas>
                </div>
            </div>
            <div class="card-events">
                <h2 class="text-center">Receita gerada por Evento</h2>
                <div class="canvas-wrapper">
                    <canvas id="tickets-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    </div>

</x-blank>
