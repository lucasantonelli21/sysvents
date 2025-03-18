<x-blank>


    <div class="card">
        <div class="card-header text-light">
            @if ($ticketType->id)
                <h2 class="text-center">Atualize o Ingresso do Tipo  {{ $ticketType->name }} do evento : {{ $event->name }}</h2>
            @else
                <h2 class="text-center">Crie um novo Expositor</h2>
            @endif
        </div>

        <form class="form" action="{{ route($ticketType->id ? 'panel.events.tickets.types.update' : 'panel.events.tickets.types.create', $ticketType->id ? [$event->id,$ticketType->id] : $event->id) }}"
            method="post" required>
            <div class="card-body">


                @method($ticketType->id ? 'PUT' : 'POST')
                @csrf

                <input type="hidden" name="id" value="{{ $ticketType->id }}">

                <div class="form-group">
                    <label class="form-label" for="name">Nome do Tipo de Ingresso</label>
                    <input class="form-control" type="text" name="name" id="name"
                        value="{{ old('name', $ticketType->name) }}" required>
                </div>

            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-outline-primary">Salvar</button>
            </div>

        </form>
    </div>

</x-blank>
