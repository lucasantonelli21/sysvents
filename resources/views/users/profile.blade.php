@php
    $user = Auth::user();
@endphp
<x-blank>

    <div class="card">
        <div class="card-header">
            <div class="row-title-button">
                <h1 class = "title text-center">Perfil de {{ $user->name }}</h1>
                <a href="{{route('users.edit',$user->id)}}" class="btn btn-outline-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pen" viewBox="0 0 16 16">
                        <path
                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                    </svg>
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
                            class="badge rounded-pill bg-light">{{ date('d/m/Y', strtotime($user->birth_date)) }}</h4></span>
                </li>
            </ul>
        </div>
    </div>

</x-blank>
