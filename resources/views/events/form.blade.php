@php
    use App\Enums\Themes;
@endphp
<x-blank>
    {{-- @dd($movie) --}}

    <div class="event-Form">
        <div class="card">
            <div class="card-header">
                <div class="row-title-button">
                    <a href="{{ url()->previous() }}" class="icons btn-back btn-back btn btn-outline-light">
                        <img src="{{ asset('images/icons/arrow-left-circle.svg') }}" alt="">
                    </a>
                    @if ($event->id)
                        <h2 class="title">Atualize o Evento: {{ $event->name }}</h2>
                    @else
                        <h2 class="title">Crie um novo Evento</h2>
                    @endif


                </div>
            </div>




            <form class="form" action="{{ route($event->id ? 'panel.events.update' : 'panel.events.save') }}"
                method="post" id="form-event" enctype="multipart/form-data">
                <div class="card-body">


                    @method($event->id ? 'PUT' : 'POST')
                    @csrf

                    <input type="hidden" name="id" value="{{ $event->id }}">

                    <div class="card-body d-flex gap-2">

                        <div class="imageInfo p-1 ">
                            <div class="imageEvent ">
                                <label for="image_path">
                                    <img id = "output"
                                        src="{{ $event->image_path ? Storage::disk('public')->url($event->image_path) : Storage::url('events/default-image.jpg') }}"
                                        class="rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="editImageIcon bi bi-pencil-square"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <pasvgth fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </label>
                            </div>
                            <div class="form-group mt-2">

                                <input name = "image_path" id = "image_path" class ="form-control" type="file"
                                    name="image_path" id ="image_path" onchange="loadFile(event)">
                                <script>
                                    var loadFile = function(event) {
                                        var output = document.getElementById('output');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                        output.onload = function() {
                                            URL.revokeObjectURL(output.src);
                                        }
                                    };
                                </script>
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

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="free" id="free" value="1"
                                {{ old('free', $is_free) ? 'checked' : '' }}>
                                <label class="form-check-label" for='free'>Evento Gratuito?</label>
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

                            <label class="form-label" for="theme">Tema</label>

                            <select class="form-control" name="theme" id="theme" required>
                                <option value="">Selecione uma opção</option>
                                @foreach (Themes::cases() as $theme)
                                    <option value="{{ $theme }}"
                                        {{ old('theme', $event->theme) == $theme ? 'selected' : '' }}>
                                        {{ $theme }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-sm">
                            <label class="form-label" for="batch">Lote</label>
                            <input class="form-control" type="text" name="batch" id="batch"
                                value="{{ old('batch', $event->batch) }}" required>
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-sm">
                            <label class="form-label" for="cep">CEP</label>
                            <input class="form-control" type="text" name="cep" id="cep"
                                value="{{ old('cep', $event->cep) }}" required>
                        </div>
                        <div class="form-group col-sm">
                            <label class="form-label" for="address">Logradouro</label>
                            <input class="form-control" type="text" name="address" id="address"
                                value="{{ old('address', $event->address) }}" required>
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-sm">
                            <label class="form-label" for="neighborhood">Bairro</label>
                            <input class="form-control" type="text" name="neighborhood" id="neighborhood"
                                value="{{ old('neighborhood', $event->neighborhood) }}" required>
                        </div>

                        <div class="form-group col-sm">
                            <label class="form-label" for="address_number">Número</label>
                            <input class="form-control" type="text" name="address_number" id="address_number"
                                value="{{ old('address_number', $event->address_number) }}" >
                        </div>

                        <div class="form-group col-sm">
                            <label class="form-label" for="complement">Complemento</label>
                            <input class="form-control" type="text" name="complement" id="complement"
                                value="{{ old('complement', $event->complement) }}" required>
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-sm">
                            <label class="form-label" for="city">Cidade</label>
                            <input class="form-control" type="text" name="city" id="city"
                                value="{{ old('city', $event->city) }}" required>
                        </div>
                        <div class="form-group col-sm">
                            <label class="form-label" for="state">Estado</label>
                            <input class="form-control" type="text" name="state" id="state"
                                value="{{ old('state', $event->state) }}" required>
                        </div>

                    </div>

                    <input type="text" value="{{ old('latitude', $event->latitude) }}" name="latitude"
                        id="latitude" hidden>
                    <input type="text" value="{{ old('longitude', $event->longitude) }}" name="longitude"
                        id="longitude" hidden>

                    <div class="map"></div>

                </div>
                <div class="card-footer text-end">
                    <button class="btn-actions btn btn-light">{{ $event->id ? 'Atualizar' : 'Cadastrar' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-blank>
