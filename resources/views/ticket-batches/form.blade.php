<x-blank>


    <div class="card">
        <div class="card-header text-light">
            @if ($ticketBatch->id)
                <h2 class="text-center">Atualize o Lote{{ $ticketBatch->name }} o Ingresso do Tipo  {{ $ticketType->name }} do evento : {{ $event->name }}</h2>
            @else
                <h2 class="text-center">Crie um novo Lote</h2>
            @endif
        </div>

        <form class="form" action="{{ route($ticketBatch->id ? 'panel.events.tickets.types.batches.update' : 'panel.events.tickets.types.batches.create', $ticketBatch->id ? [$event->id,$ticketType->id,$ticketBatch->id] : [$event->id,$ticketType->id]) }}"
            method="post" required>
            <div class="card-body">


                @method($ticketBatch->id ? 'PUT' : 'POST')
                @csrf

                <input type="hidden" name="id" value="{{ $ticketBatch->id }}">

                <div class="form-group">
                    <label class="form-label" for="batch">Número do Lote</label>
                    <input class="form-control" type="number" name="batch"
                        value="{{ old('batch') ? old('batch') : $ticketBatch->batch }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="name">Nome do Lote</label>
                    <input class="form-control" type="text" name="name"
                        value="{{ old('name') ? old('name') : $ticketBatch->name }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="name">Preço do Lote</label>
                    <input class="form-control" type="price" name="price"
                        value="{{ old('price') ? old('price') : $ticketBatch->price }}" required>
                </div>

            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-outline-primary">Salvar</button>
            </div>

        </form>
    </div>

</x-blank>
