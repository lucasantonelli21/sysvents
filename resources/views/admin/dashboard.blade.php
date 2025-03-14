<x-blank>
    <div class="page-dashboard">
        <div class="header-wrapper">
            <h1 class="title text-center">DashBoard para Administradores</h1>
            <div class="modal-card">

                <button type="button" class="btn-filter btn btn-outline-light" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-funnel" viewBox="0 0 16 16">
                        <path
                            d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                    </svg>
                </button>

            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Selecione seus Eventos</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form class="form" action="{{ route('panel.dashboard') }}">
                            <div class="modal-body">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label">Nome</label>
                                        <select name="events[]" class="form-control" id="select2-events" multiple="multiple"></select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-light" href="{{ route('panel.dashboard') }}">Limpar
                                        Filtro</a>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
