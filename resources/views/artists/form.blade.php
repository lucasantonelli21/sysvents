@php
    $dateYearsAgo = date('Y-m-d', strtotime('-15 years'));

@endphp

<x-blank>


    <div class="card">
        <div class="card-header">
            <div class="row-title-button">
                <a href="{{ url()->previous() }}" class="btn-back btn btn-outline-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="icon-large bi bi-arrow-left-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                    </svg>
                </a>
                <h2 class="title text-center">
                    {{ $artist->id ? 'Atualize o Artista ' . $artist->name : 'Cadastrar Artista' }}
                </h2>
            </div>
        </div>
        <form
            action=" {{ route($artist->id ? 'panel.artists.update' : 'panel.artists.create', $artist->id ?? [$artist->id]) }}"
            method="POST">
            @csrf
            @method($artist->id ? 'PUT' : 'POST')
            <div class="card-body">
                @if ($artist->id)
                    <div class="form-group">
                        <input type="hidden" class="form-control" data-bs-theme="dark" type="text" name="id"
                            required value="{{ $artist->id }}" />
                    </div>
                @endif
                <div class="form-group">
                    <label class="form-label">Nome</label>
                    <input class="form-control" data-bs-theme="dark" type="text" name="name" required
                        value="{{ old('name') ? old('name') : $artist->name }}" />
                </div>
                <div class="form-group">
                    <label class="form-label">Data de Nascimento</label>
                    <input class="form-control" data-bs-theme="dark" max="{{ $dateYearsAgo }}" type="date"
                        name="birth_date" required
                        value="{{ old('birth_date') ? old('birth_date') : $artist->birth_date }}" />
                </div>
                <div class="form-group">
                    <label class="form-label">Cachê</label>
                    <input class="form-control" data-bs-theme="dark" type="number" name="fee" required
                        value="{{ old('fee') ? old('fee') : $artist->fee }}" />
                </div>
                <div class="form-group">
                    <label class="form-label">Telefone</label>
                    <input class="form-control" data-bs-theme="dark" type="phone" name="phone" required
                        value="{{ old('phone') ? old('phone') : $artist->phone }}" />
                </div>
            </div>
            <div class="card-footer text-end">
                <button class="btn-actions btn btn-light">{{ $artist->id ? 'Atualizar' : 'Cadastrar' }}</button>
            </div>
        </form>
    </div>

</x-blank>
