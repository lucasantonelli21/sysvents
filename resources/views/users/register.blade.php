@php
    $dateYearsAgo = date('Y-m-d', strtotime('-15 years'));
@endphp


<x-blank>
    <div class="page-register card bg-dark">
        <div class="card-header">
            <h2 class="title text-center">Se Registre Aqui!</h2>
        </div>
        <form action="{{ route('user.save') }}" method="POST">
            @csrf
            <div class="card-body bg-dark">
                <div class="form-group">
                    <label class="form-label">Nome</label>
                    <input class="form-control" data-bs-theme="dark" type="text" name="name" required value="{{ old('name') }}" />
                </div>
                <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input class="form-control" data-bs-theme="dark" type="email" name="email" required value="{{ old('email') }}" />
                </div>
                <div class="form-group">
                    <label class="form-label">CPF</label>
                    <input class="form-control" data-bs-theme="dark" type="text" name="cpf" required value="{{ old('cpf') }}" />
                </div>
                <div class="form-group">
                    <label class="form-label">Data de Aniversário</label>
                    <input class="form-control" data-bs-theme="dark" max="{{ $dateYearsAgo }}" type="date" name="birth_date" required value="{{ old('birth_date') }}" />
                </div>
                <div class="form-group">
                    <label class="form-label">Telefone</label>
                    <input class="form-control" data-bs-theme="dark" type="phone" name="phone" required value="{{ old('phone') }}" />
                </div>
                <div class="password-row">
                    <div class="form-group">
                        <label class="form-label">Senha</label>
                        <input class="password form-control" data-bs-theme="dark" type="password" name="password" required  />
                    </div>
                    <div class="form-group">
                        <div class="d-flex flex-row"">
                            <label class="form-label">Confirme sua Senha</label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="img-check bi bi-check2" viewBox="0 0 16 16">
                                <path
                                    d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0" />
                            </svg>
                        </div>
                        <input class="password-confirmation form-control" data-bs-theme="dark" type="password" name="password_confirmation" required  />
                    </div>
                </div>
            </div>
            <div class="text-end card-footer bg-dark">
                <button class="btn-actions btn btn-light">Cadastrar</button>
            </div>

        </form>
    </div>
</x-blank>
