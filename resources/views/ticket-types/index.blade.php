<x-blank>


    <div class="index-pages card">
        <div class="card-header">

            <div class="row-title-button">
                <a href="{{ route('panel.events.index') }}" class="icons btn-back btn btn-outline-light">
                    <img src="{{ asset('images/icons/arrow-left-circle.svg') }}" alt="">
                </a>
                <h2 class="title text-center">Tipos de Ingresso do Evento <span
                        class="text-info">{{ $event->name }}</span></h2>
                <a class="icons btn btn-outline-primary"
                    href="{{ route('panel.events.tickets.types.register', $event->id) }}">
                    <img src="{{ asset('images/icons/plus.svg') }}" alt="">
                </a>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-striped custom-table">
                    <tr>
                        <th>Nome</th>
                        <th>Lotes Cadastrados</th>
                        <th>Criado em</th>
                        <th>Atualizado em</th>
                        <th>Ações</th>
                    </tr>

                    @foreach ($ticketTypes as $ticketType)
                        <tr>
                            <td>{{ $ticketType->name }}</td>
                            <td>{{ count($ticketType->ticketBatches) }}</td>
                            <td>{{ formatDate($ticketType->created_at, 'd/m/Y') }}</td>
                            <td>{{ formatDate($ticketType->updated_at, 'd/m/Y') }}</td>
                            <td>
                                <div class= "table-buttons">
                                    <a href="{{ route('panel.events.tickets.types.edit', [$event->id, $ticketType->id]) }}"
                                        class="icons btn btn-outline-info">
                                        <img src="{{ asset('images/icons/pen.svg') }}" alt="">
                                    </a>
                                    <form
                                        action="{{ route('panel.events.tickets.types.delete', [$event->id, $ticketType->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icons btn btn-outline-danger">
                                            <img src="{{ asset('images/icons/trash.svg') }}" alt="">
                                        </button>
                                    </form>
                                    <a href="{{ route('panel.events.tickets.types.batches.index', [$event->id, $ticketType->id]) }}"
                                        class="icons btn btn-outline-success">
                                        <img src="{{ asset('images/icons/ticket.svg') }}" alt="">
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>

</x-blank>
