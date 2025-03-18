@php
    $paginations = [10, 15, 20, 30];
@endphp
<x-blank>

    <div class="index-pages card">
        <div class="card-header text-light">
            <div class="card-row">
                <div class="select-pagination">
                    <form class="form-pagination" action="{{ route('panel.events.tickets.index', $event->id) }}">

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

                    <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
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
                                    <button type="submit" class="btn btn-outline-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
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
