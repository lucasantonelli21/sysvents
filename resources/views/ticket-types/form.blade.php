<x-blank>


    <div class="card">
        <div class="card-header text-light">
            <div class="row-title-button">
                <a href="{{ url()->previous() }}" class="btn-back btn btn-outline-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon-large bi bi-arrow-left-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                      </svg>
                </a>
                @if ($ticketType->id)
                    <h2 class="title">Atualize o Ingresso do Tipo  {{ $ticketType->name }} do evento <span class="text-info">{{$event->name}}</span></h2>
                @else
                    <h2 class="title">Crie um novo Tipo de Ingresso do evento <span class="text-info">{{$event->name}}</span></h2>
                @endif
            </div>
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
