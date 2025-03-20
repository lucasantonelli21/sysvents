<x-blank>


        <div class="card">
            <div class="card-header text-light">
                <div class="row-title-button">
                    <a href="{{ url()->previous() }}" class="btn-back btn btn-outline-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon-large bi bi-arrow-left-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                          </svg>
                    </a>
                    @if ($exhibitor->id)
                        <h2 class="title">Atualize o Expositor: {{ $exhibitor->name }}</h2>
                    @else
                        <h2 class="title">Crie um novo Expositor</h2>
                    @endif
                </div>
            </div>

                <form class="form" action="{{ route($exhibitor->id ? 'panel.exhibitors.update' : 'panel.exhibitors.save') }}"
                    method="post" required>
                    <div class="card-body">


                    @method($exhibitor->id ? 'PUT' : 'POST')
                    @csrf

                    <input type="hidden" name="id" value="{{ $exhibitor->id }}">

                    <div class="form-group">
                        <label class="form-label" for="name">Nome do Expositor</label>
                        <input class="form-control" type="text" name="name" id="name"
                            value="{{ old('name', $exhibitor->name) }}" required>
                    </div>

                    @php
                        $categories = [
                            'cultural' => 'Cultural',
                            'musical' => 'Musical',
                            'children' => 'Infantis',
                            'fashion' => 'Moda',
                            'technology' => 'Tecnologia',
                            'gastronomy' => 'Gastronomia',
                        ];
                    @endphp

                    <div class="form-group">

                        <label class="form-label" for="Category">Categoria</label>

                        <select class="form-control" name="category" id="Category" required>
                            <option value="">Selecione uma opção</option>
                            @foreach ($categories as $key => $name)
                                <option value="{{ $key }}"
                                    {{ old('category', $exhibitor->category) == $key ? 'selected' : '' }}>
                                    {{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">Descrição</label>
                        <textarea class="form-control" type="text" name="description" id="description" required>{{ old('description', $exhibitor->description) }} </textarea>
                    </div>

                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-outline-primary">Salvar</button>
                </div>

            </form>
        </div>

</x-blank>
