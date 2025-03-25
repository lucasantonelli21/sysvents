<x-blank>
    <div class="page-dashboard">
        {{-- @dd($eventsName) --}}
        <div class="header-wrapper">
            <h1 class="title text-center">DashBoard para Administradores</h1>
            <div class="modal-card">

                <button type="button" class="icons btn-filter btn btn-outline-light" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <img src="{{ asset('images/icons/filter.svg') }}" alt="">
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
                                        <select name="events[]" class="form-control" id="select2-events"
                                            multiple="multiple">
                                            @if ($eventsName)
                                                @foreach ($eventsName as $value => $name)
                                                    <option selected value="{{ $value }}">{{ $name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
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
            {{-- <div class="canvas-wrapper"> --}}
            <canvas id="event-chart"></canvas>
            {{-- </div> --}}
        </div>
        <div class="card-events">
            <h2 class="text-center">Receita gerada por Evento</h2>
            {{-- <div class="canvas-wrapper"> --}}
            <canvas id="tickets-chart"></canvas>
            {{-- </div> --}}
        </div>
    </div>
    </div>
    </div>

</x-blank>
