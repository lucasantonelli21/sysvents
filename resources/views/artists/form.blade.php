@php
    $dateYearsAgo = date('Y-m-d', strtotime('-15 years'));

@endphp

<x-blank>


    <div class="card">
        <div class="card-header">
            <h2 class="title text-center">{{ $artist->id ? 'Atualize o Artista ' . $artist->name : 'Cadastrar Artista' }}
            </h2>
        </div>
        <form action=" {{ route($artist->id ? 'artists.update' : 'artists.create', $artist->id ?? [$artist->id])  }}" method="POST">
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
