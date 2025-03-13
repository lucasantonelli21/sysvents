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
                    <form class="form-pagination" action="{{ route('exhibitors.index') }}">
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

                    <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-funnel" viewBox="0 0 16 16">
                            <path
                                d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                        </svg>
                    </button>

                    <a href="{{ route('exhibitors.create') }}" class="btn btn-outline-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-square" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                        </svg>
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
                            <form class="form-filter" action="{{ route('exhibitors.index') }}">
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
                                            href="{{ route('exhibitors.index') }}">Limpar
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

        <div class="card-body ">
            <div class="table-responsive ">
                <table class="table-exhibitors table table-striped custom-table">
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <th>Criado em</th>
                        <th>Editado em</th>
                        <th>Ações</th>
                    </tr>
                    @foreach ($exhibitors as $exhibitor)
                        <tr>
                            <td class='name-cell'>{{ $exhibitor->name }}</td>
                            @foreach ($categories as $category => $name)
                                @if ($exhibitor->category == $category)
                                    <td class="category-cell">{{ $name }}</td>
                                @endif
                            @endforeach
                            <td class="description-cell">{{ $exhibitor->description }}</td>
                            <td>{{ formatDate($exhibitor->created_at, 'd/m/Y') }}</td>
                            <td>{{ formatDate($exhibitor->updated_at, 'd/m/Y') }}</td>
                            <td>

                                {{-- @if (isset(Auth::user()->is_admin) && Auth::user()->is_admin) --}}
                                <div class= "table-buttons">
                                    <a href="{{ route('exhibitors.edit', $exhibitor->id) }}" class="btn btn-outline-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path
                                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('exhibitors.delete', $exhibitor->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg>
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
