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




                <form class="form" action="{{ route($event->id ? 'panel.events.update' : 'panel.events.save') }}"
                    method="post" enctype="multipart/form-data">
                    <div class="card-body">


                        @method($event->id ? 'PUT' : 'POST')
                        @csrf

                        <input type="hidden" name="id" value="{{ $event->id }}">

                        <div class="card-body d-flex gap-2">
                            <div class="imageInfo">
                                <img src="{{ $event->image_path ? asset($event->image_path) : 'assets/images/default-event-image.jpeg' }}"
                                    class="rounded">
                                <div class="form-group">

                                    <label for=""></label>
                                    <input class ="form-control" type="file" name="image_path" id ="image_path"
                                        value="{{ old('name', asset($event->image_path)) }}">
                                </div>
                            </div>
                            <div class="image-overlay d-flex justify-content-center flex-column rounded">
                            </div>
                            <div class="afterImage w-100">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nome do Evento</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                        value="{{ old('name', $event->name) }}" required>
                                </div>

                                <div class="form-group ">
                                    <label class="form-label" for="description">Descrição</label>
                                    <textarea rows="9" cols="50" class="form-control w-100" type="text" name="description" id="description"
                                        required>{{ old('description', $event->description) }} </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm">
                                <label class="form-label">Data de Início</label>
                                <input class="form-control" type="datetime-local" id="date-time" name="start_date"
                                    value="{{ old('start_date') ? formatDate(old('start_date'), 'Y-m-d\TH:i') : formatDate($event->start_date, 'Y-m-d\TH:i') }}"
                                    min="2024-06-07T00:00" max="2028-06-14T00:00" />
                            </div>

                            <div class="form-group col-sm">
                                <label class="form-label">Data do Fim</label>
                                <input class="form-control" type="datetime-local" id="date-time" name="end_date"
                                    value="{{ old('end_date') ? formatDate(old('end_date'), 'Y-m-d\TH:i') : formatDate($event->end_date, 'Y-m-d\TH:i') }}"
                                    min="2023-06-07T00:00" max="2028-06-14T00:00" />
                            </div>

                        </div>


                        <div class="row">

                            <div class="form-group col-sm">
                                <label class="form-label" for="longitude">Longitude</label>
                                <input class="form-control" type="text" name="longitude" id="longitude"
                                    value="{{ old('longitude', $event->longitude) }}" required>
                            </div>
                            <div class="form-group col-sm">
                                <label class="form-label" for="latitude">Latitude</label>
                                <input class="form-control" type="text" name="latitude" id="latitude"
                                    value="{{ old('latitude', $event->latitude) }}" required>
                            </div>
                        </div>
                        <div class="row">
                            @php
                                $themes = [
                                    'technology' => 'Tecnologia',
                                    'cultural' => 'Cultura',
                                    'musical' => 'Música',
                                    'art' => 'Arte',
                                    'sport' => 'Esportes',
                                    'gastronomy' => 'Gastronomia',
                                    'health' => 'Saúde e Bem-estar',
                                ];

                            @endphp

                            <div class="form-group col-sm">

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

                            <div class="form-group col-sm">
                                <label class="form-label" for="batch">Lote</label>
                                <input class="form-control" type="text" name="batch" id="batch"
                                    value="{{ old('batch', $event->batch) }}" required>
                            </div>
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
