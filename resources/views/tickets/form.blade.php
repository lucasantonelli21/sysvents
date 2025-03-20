<x-blank>


    <div class="card">
        <div class="card-header text-light">
            @if ($user)
                <h2 class="text-center">Atualize o Ingresso do Usuário:  {{ $user->name }} do evento : {{ $event->name }}</h2>
            @else
                <h2 class="text-center">Crie um novo Ingresso</h2>
            @endif
        </div>
        <form class="form" action="{{ route($user ? 'panel.events.tickets.update' : 'panel.events.tickets.save', $event->id) }}"
            method="post" required>
            <div class="card-body">

                @method($user ? 'PUT' : 'POST')
                @csrf
                <input type="hidden" name="id" value="{{ $event->id }}">

                <div class="form-group">
                    <label class="form-label" for="email">Email do Usuário</label>
                    <input class="form-control" type="text" name="email" id="email"
                        value="{{ old('email', $user ? $user->email : '') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="ticket_type">Tipo do Ingresso</label>
                    <select class = "form-control" name="ticket_type" id="ticket_type">
                        @foreach ($ticket_types as $ticket_type)
                        <option value="{{ $ticket_type->id }}" {{ old('ticket_type', $ticket->ticket_batch->ticket_type_id ?? '') == $ticket_type->id ? 'selected' : '' }}>
                            {{ $ticket_type->name }}
                        </option>
                    @endforeach
                    </select>

                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-outline-primary">Salvar</button>
            </div>

        </form>
    </div>

</x-blank>
