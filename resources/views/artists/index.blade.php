@php
    $paginations = [10, 15, 20, 30];
@endphp
<x-blank>
    <div class="index-pages card">
        <div class="card-header">
            <div class="card-row">

                <div class="select-pagination">
                    <form class="form-pagination" action="{{ route('artists.index') }}">
                        <select class="paginator-selector" name="pagination">
                            @foreach ($paginations as $value)
                                <option {{ $value == request()->pagination ? 'selected' : '' }}
                                    value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>


                <h2 class="title text-center">Artistas</h2>

                <div class="modal-card">

                    <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-funnel" viewBox="0 0 16 16">
                            <path
                                d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                        </svg>
                    </button>

                    <a href="{{ route('artists.register') }}" class="btn btn-outline-primary">
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
                            <form class="form-filter" action="{{ route('artists.index') }}">
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="form-label">Nome</label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ Request::get('name') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Cachê</label>
                                            <input class="form-control" type="number" name="fee"
                                                value="{{ Request::get('fee') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Telefone</label>
                                            <input class="form-control" type="phone" name="phone"
                                                value="{{ Request::get('phone') }}" />
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label class="form-label">Nascidos de</label>
                                                <input class="form-control" type="date" max={{ now() }}
                                                    name="birth_date_min"
                                                    value="{{ Request::get('birth_date_min') }}" />
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="form-label">Nascidos Até</label>
                                                <input class="form-control" type="date" max={{ now() }}
                                                    name="birth_date_max"
                                                    value="{{ Request::get('birth_date_max') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-light"
                                            href="{{ route('artists.index') }}">Limpar
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
    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-striped custom-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">Cachê</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Criado em</th>
                        <th scope="col">Editado em</th>

                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artists as $artist)
                        <tr>
                            <th scope="row">{{ $artist->id }}</th>
                            <td>{{ $artist->name }}</td>
                            <td>{{ formatDate($artist->birth_date, 'd/m/Y') }}</td>
                            <td>R$ {{ $artist->fee }}</td>
                            <td>{{ $artist->phone }}</td>
                            <td>{{ formatDate($artist->created_at,'d/m/Y') }}</td>
                            <td>{{ formatDate($artist->updated_at,'d/m/Y') }}</td>
                            <td>
                                <div class="table-buttons">
                                    <a href="{{ route('artists.edit', [$artist->id]) }}" class="btn btn-outline-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path
                                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('artists.delete', [$artist->id]) }}" method="POST">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-end">
        {{ $artists }}
    </div>
    </div>
</x-blank>
