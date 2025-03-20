@php
    $paginations = [10, 15, 20, 30];
@endphp
<x-blank>

    <div class="index-pages card">
        <div class="card-header text-light">
            <div class="card-row">
                <div class="select-pagination">
                    <form class="form-pagination" action="{{ route('panel.events.tickets.index', $event->id) }}">
                        <a href="{{ url()->previous() }}" class="icons btn-back btn btn-outline-light">
                            <img src="{{ asset('images/icons/arrow-left-circle.svg') }}" alt="">
                        </a>
                        <select class="paginator-selector" name="pagination">
                            @foreach ($paginations as $value)
                                <option {{ $value == request()->pagination ? 'selected' : '' }}
                                    value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <h2 class="title text-center">Tickets do Evento: {{ $event->name }}</h2>
                <div class="modal-card">

                    <div class="modal-card">
                    <button type="button" class="icons filter btn btn-outline-light" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <img src="{{ asset('images/icons/filter.svg') }}" alt="">
                    </button>

                    <a href="{{ route('panel.events.tickets.create', $event->id) }}" class="btn btn-outline-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-square" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                        </svg>
                    </a>
                    </div>
                </div>


                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Selecione seus filtros</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="form-filter" action="{{ route('panel.events.tickets.index', $event->id) }}">
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="form-label">Nome do Comprador</label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ Request::get('name') }}" />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Lote</label>
                                            <input class="form-control" type="number" name="batch"
                                                value="{{ Request::get('batch') }}" />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Tipo de Ingresso</label>
                                            <select class="form-control" name="ticket_type">
                                                <option value="">Selecione o Tipo de Ingresso</option>
                                                @foreach ($event->ticketTypes as $ticketType)
                                                    <option
                                                        {{ Request::get('ticket_type') == $ticketType->name ? 'selected' : '' }}
                                                        value="{{ $ticketType->name }}">{{ $ticketType->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Preço</label>
                                            <input class="form-control" type="number" name="price"
                                                value="{{ Request::get('price') }}" />
                                        </div>



                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-light"
                                            href="{{ route('panel.events.tickets.index', $event->id) }}">Limpar
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
    </div>

    <div class="card-body ">
        <div class="table-responsive ">
            <table class="table table-striped custom-table">

                <tr>
                    <th>ID do Ingresso</th>
                    <th>Nome do Comprador</th>
                    <th>Lote</th>
                    <th>Tipo do Ticket</th>
                    <th>Preço do Ingresso</th>
                    <th>Ações</th>
                </tr>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->ticket_id }}</td>
                        <td>{{ $ticket->users_name }}</td>
                        <td>{{ $ticket->ticket_batches_batch }}</td>
                        <td>{{ $ticket->ticket_types_name }}</td>
                        <td>{{ $ticket->ticket_batches_price }}</td>
                        <td>
                            <div class= "table-buttons">
                                <form
                                    action="{{ route('panel.events.tickets.delete', [$event->id, $ticket->ticket_id]) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icons btn btn-outline-danger">
                                        <img src="{{ asset('images/icons/trash.svg') }}" alt="">
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
    <div class="card-footer text-end">
        {{ $tickets->links() }}
    </div>
    </div>

</x-blank>
