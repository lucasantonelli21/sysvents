<x-blank>


    <div class="index-pages card">
        <div class="card-header">

            <div class="row-title-button">
                <a href="{{ route('panel.events.index') }}" class="icons btn-back btn btn-outline-light">
                    <img src="{{ asset('images/icons/arrow-left-circle.svg') }}" alt="">
                 </a>
                <h2 class="title text-center">Lotes do Ingresso <span class="text-primary">{{ $ticketType->name }}</span> do Evento <span class="text-info">{{ $event->name }}</span></h2>
                <a class="icons btn btn-outline-primary" href="{{ route('panel.events.tickets.types.batches.register', [$event->id, $ticketType->id]) }}">
                    <img src="{{ asset('images/icons/plus.svg') }}" alt="">
                </a>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-striped custom-table">
                    <tr>
                        <th>Número do Lote</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Criado</th>
                        <th>Atualizado</th>
                        <th>Ações</th>
                    </tr>

                    @foreach ($ticketBatches as $ticketBatch)
                        <tr>
                            <td>{{ $ticketBatch->batch }}</td>
                            <td>{{ $ticketBatch->name }}</td>
                            <td>R${{ $ticketBatch->price }}</td>
                            <td>{{ formatDate($ticketBatch->created_at, 'd/m/Y') }}</td>
                            <td>{{ formatDate($ticketBatch->updated_at, 'd/m/Y') }}</td>
                            <td>
                                <div class= "table-buttons">
                                    <a href="{{ route('panel.events.tickets.types.batches.edit', [$event->id, $ticketType->id, $ticketBatch->id]) }}"
                                        class="icons btn btn-outline-info">
                                        <img src="{{ asset('images/icons/pen.svg') }}" alt="">
                                    </a>
                                    <form action="{{ route('panel.events.tickets.types.batches.delete',[$event->id,$ticketType->id,$ticketBatch->id]) }}" method="POST">
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
        <div class="card-footer"></div>
    </div>

</x-blank>
