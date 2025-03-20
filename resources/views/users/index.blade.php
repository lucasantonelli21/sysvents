@php
    $paginations = [10, 15, 20, 30];
@endphp
<x-blank>
    <div class="index-pages card">
        <div class="card-header">
            <div class="card-row">
                <div class="select-pagination">
                    <form class="form-pagination" action="{{ route('panel.users.index') }}">
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


                <h2 class="title text-center">Usuários</h2>

                <div class="modal-card">

                    <button type="button" class="icons btn btn-outline-light" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <img src="{{ asset('images/icons/filter.svg') }}" alt="">
                    </button>

                    <a href="{{ route('users.register') }}" class="icons btn btn-outline-primary">
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
                            <form class="form-filter" action="{{ route('panel.users.index') }}" method="GET">
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="form-label">Nome</label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ Request::get('name') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">E-mail</label>
                                            <input class="form-control" type="email" name="email"
                                                value="{{ Request::get('email') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Cpf</label>
                                            <input class="form-control" type="text" name="cpf"
                                                value="{{ Request::get('cpf') }}" />
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
                                            href="{{ route('panel.users.index') }}">Limpar
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
                        <th scope="col">Cpf</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Data de Aniversário</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Perfil</th>
                        <th scope="col">Criado em</th>
                        <th scope="col">Editado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->cpf }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ formatDate($user->birth_date, 'd/m/Y') }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->is_admin ? 'Administrador' : 'Cliente' }}</td>
                            <td>{{ formatDate($user->created_at,'d/m/Y') }}</td>
                            <td>{{ formatDate($user->created_at,'d/m/Y') }}</td>
                            <td>
                                <div class="table-buttons">
                                    <a href="{{ route('users.edit', [$user->id]) }}" class="icons btn btn-outline-info">
                                       <img src="{{ asset('images/icons/pen.svg') }}" alt="">
                                    </a>
                                    <form action="{{ route('panel.users.delete', [$user->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icons btn btn-outline-danger">
                                           <img src="{{ asset('images/icons/trash.svg') }}" alt="">
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
        {{ $users->links() }}
    </div>
    </div>
</x-blank>
