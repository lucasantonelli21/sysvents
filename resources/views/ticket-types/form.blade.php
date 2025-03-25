<x-blank>


    <div class="card">
        <div class="card-header text-light">
            <div class="row-title-button">
                <a href="{{ url()->previous() }}" class="icons btn-back btn btn-outline-light">
                   <img src="{{ asset('images/icons/arrow-left-circle.svg') }}" alt="">
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
