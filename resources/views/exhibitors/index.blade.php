@php
    $paginations = [10, 15, 20, 30];

    $categories = [
        'cultural' => 'Cultural',
        'musical' => 'Musical',
        'children' => 'Infantis',
        'fashion' => 'Moda',
        'technology' => 'Tecnologia',
        'gastronomy' => 'Gastronomia',
    ];
@endphp
<x-blank>

    <div class="index-pages card">
        <div class="card-header text-light">
            <div class="card-row">

                <div class="select-pagination">
                    <form class="form-pagination" action="{{ route('panel.exhibitors.index') }}">
                        <a href="{{ url()->previous() }}" class="icons btn-back btn btn-outline-light">
                            <img src="{{ asset('images/icons/arrow-left-circle.svg') }}" alt="">
                        </a>
                        <select class="paginator-selector" name="pagination">
                            @foreach ($paginations as $value)
                                <option {{ $value == request()->pagination ? 'selected' : '' }}
                                    value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>


                <h2 class="title text-center">Expositores</h2>

                <div class="modal-card">

                    <button type="button" class="filter icons btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="{{ asset('images/icons/filter.svg') }}" alt="">
                    </button>

                    <a href="{{ route('panel.exhibitors.create') }}" class="icons btn btn-outline-primary">
                        <img src="{{ asset('images/icons/plus.svg') }}" alt="">
                    </a>

                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Selecione seus filtros</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="form-filter" action="{{ route('panel.exhibitors.index') }}">
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="form-label">Nome</label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ Request::get('name') }}" />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Categoria</label>
                                            <select class="form-control" name="category">
                                                <option value="">Selecione uma opção</option>
                                                @foreach ($categories as $value => $name)
                                                    <option {{ Request::get('category') == $value ? 'selected' : '' }}
                                                        value="{{ $value }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-light"
                                            href="{{ route('panel.exhibitors.index') }}">Limpar
                                            Filtro</a>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Filtrar</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="card-body ">
            <div class="table-responsive ">
                <table class="table table-striped custom-table">
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th class="text-center">Descrição</th>
                        <th>Criado</th>
                        <th>Editado</th>
                        <th>Ações</th>
                    </tr>
                    @foreach ($exhibitors as $exhibitor)
                        <tr>
                            <td>{{ $exhibitor->name }}</td>
                            @foreach ($categories as $category => $name)
                                @if ($exhibitor->category == $category)
                                    <td class="category-cell">{{ $name }}</td>
                                @endif
                            @endforeach
                            <td>{{ $exhibitor->description }}</td>
                            <td>{{ formatDate($exhibitor->created_at, 'd/m/Y') }}</td>
                            <td>{{ formatDate($exhibitor->updated_at, 'd/m/Y') }}</td>
                            <td>

                                {{-- @if (isset(Auth::user()->is_admin) && Auth::user()->is_admin) --}}
                                <div class= "table-buttons">
                                    <a href="{{ route('panel.exhibitors.edit', $exhibitor->id) }}" class="icons btn btn-outline-info">
                                        <img src="{{ asset('images/icons/pen.svg') }}" alt="">
                                    </a>
                                    <form action="{{ route('panel.exhibitors.delete', $exhibitor->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icons btn btn-outline-danger">
                                            <img src="{{ asset('images/icons/trash.svg') }}" alt="">
                                        </button>
                                    </form>
                                </div>
                                {{-- @endif --}}
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        {{ $exhibitors->links() }}
    </div>
    </div>

</x-blank>
