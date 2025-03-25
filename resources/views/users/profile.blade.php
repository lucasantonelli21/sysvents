@php
    $user = Auth::user();
@endphp
<x-blank>

    <div class="card">
        <div class="card-header">
            <div class="row-title-button">
                <a href="{{ url()->previous() }}" class="icons btn-back btn btn-outline-light">
                    <img src="{{ asset('images/icons/arrow-left-circle.svg') }}" alt="">
                </a>
                <h1 class = "title text-center">Perfil de {{ $user->name }}</h1>
                <a href="{{ route('users.edit', $user->id) }}" class="icons btn btn-outline-info">
                    <img src="{{ asset('images/icons/pen.svg') }}" alt="">
                </a>
            </div>
        </div>
        <div class="card-body">

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h4><span class="badge rounded-pill bg-dark">Perfil:</span> <span
                            class="badge rounded-pill {{ $user->is_admin ? 'bg-danger' : 'bg-success' }}">{{ $user->is_admin ? 'Administrador' : 'Cliente' }}
                    </h4></span>
                </li>
                <li class="list-group-item">
                    <h4><span class="badge rounded-pill bg-dark">Email:</span> <span
                            class="badge rounded-pill bg-light">{{ $user->email }}</h4></span>
                </li>
                <li class="list-group-item">
                    <h4><span class="badge rounded-pill bg-dark">Cpf:</span> <span
                            class="badge rounded-pill bg-light">{{ $user->cpf }}</h4></span>
                </li>
                <li class="list-group-item">
                    <h4><span class="badge rounded-pill bg-dark">Telefone:</span> <span
                            class="badge rounded-pill bg-light">{{ $user->phone }}</h4></span>
                </li>
                <li class="list-group-item">
                    <h4><span class="badge rounded-pill bg-dark">Data de Nascimento:</span> <span
                            class="badge rounded-pill bg-light">{{ date('d/m/Y', strtotime($user->birth_date)) }}</h4>
                    </span>
                </li>
            </ul>
        </div>
    </div>

</x-blank>
