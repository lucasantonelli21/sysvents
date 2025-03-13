<x-blank>
    {{-- @dd($movie) --}}

    <body>

        <div class="container">

            <div class="card">
                <div class="card-header text-light text-end">
                    @if ($event->id)
                        <h2 class="text-center">Atualize o Evento: {{ $event->name }}</h2>
                    @else
                        <h2 class="text-center">Crie um novo Evento</h2>
                    @endif

                </div>

                <form class="form" action="{{ route($event->id ? 'events.update' : 'events.save') }}" method="post"
                    required>
                    <div class="card-body">


                        @method($event->id ? 'PUT' : 'POST')
                        @csrf

                        <input type="hidden" name="id" value="{{ $event->id }}">

                        <div class="form-group">
                            <label class="form-label" for="name">Nome do Evento</label>
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ old('name', $event->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="description">Descrição</label>
                            <textarea class="form-control" type="text" name="description" id="description" required>{{ old('description', $event->description) }} </textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Data de Início</label>
                                <input class="form-control" type="datetime-local" id="date-time" name="start_date"
                                value="{{ old('start_date') ? formatDate(old('start_date'), 'Y-m-d\TH:i') : formatDate($event->start_date, 'Y-m-d\TH:i') }}"
                                min="2024-06-07T00:00" max="2028-06-14T00:00" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Data do Fim</label>
                            <input class="form-control" type="datetime-local" id="date-time" name="end_date"
                                value="{{ old('end_date') ? formatDate(old('end_date'), 'Y-m-d\TH:i') : formatDate($event->end_date, 'Y-m-d\TH:i') }}"
                                min="2023-06-07T00:00" max="2028-06-14T00:00" />
                        </div>

                        @php
                            $themes = [
                                'tecnologia' => 'Tecnologia',
                                'cultura' => 'Cultura',
                                'musica' => 'Música',
                                'arte' => 'Arte',
                                'esportes' => 'Esportes',
                                'gastronomia' => 'Gastronomia',
                                'saude' => 'Saúde e Bem-estar',
                            ];

                        @endphp

                        <div class="form-group">

                            <label class="form-label" for="theme">Tema</label>

                            <select class="form-control" name="theme" id="theme" required>
                                <option value="">Selecione uma opção</option>
                                @foreach ($themes as $key => $name)
                                    <option value="{{ $key }}"
                                        {{ old('theme', $event->theme) == $key ? 'selected' : '' }}>
                                        {{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="longitude">Longitude</label>
                            <input class="form-control" type="text" name="longitude" id="longitude"
                                value="{{ old('longitude', $event->longitude) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="latitude">Latitude</label>
                            <input class="form-control" type="text" name="latitude" id="latitude"
                                value="{{ old('latitude', $event->latitude) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="batch">Lote</label>
                            <input class="form-control" type="text" name="batch" id="batch"
                                value="{{ old('batch', $event->batch) }}" required>
                        </div>


                        {{-- $table->string('name');
                        $table->string('description');
                        $table->date('start_date');
                        $table->date('end_date');
                        $table->string('theme');
                        $table->decimal('longitude');
                        $table->decimal('latitude');
                        $table->integer('batch');
                        $table->timestamps(); --}}


                    </div>
                    <div class="card-footer text-end">
                        <button class="btn-actions btn btn-light">{{ $event->id ? 'Atualizar' : 'Cadastrar' }}</button>
                    </div>
                </form>
            </div>
        </div>
</x-blank>
