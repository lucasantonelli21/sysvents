<x-blank>
    {{-- @dd($movie) --}}

    <body>

        <div class="container">

            <div class="card">
                <div class="card-header bg-dark text-light">
                    @if ($exhibitor->id)
                        <h2 class="text-center">Atualize o Expositor: {{ $exhibitor->name }}</h2>
                    @else
                        <h2 class="text-center">Crie um novo Expositor</h2>
                    @endif
                </div>

                <form class="form" action="{{ route($exhibitor->id ? 'exhibitors.update' : 'exhibitors.save') }}"
                    method="post" required>
                    <div class="card-body bg-dark">


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
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>

                </form>
            </div>

        </div>
</x-blank>
