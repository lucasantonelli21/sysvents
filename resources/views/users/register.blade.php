@php
    $dateYearsAgo = date('Y-m-d', strtotime('-15 years'));
@endphp


<x-blank>
    <div class="page-form-users card bg-dark">
        <div class="card-header">
            <h2 class="title text-center">{{ $user->id ? 'Atualize o Usuário ' . $user->name : 'Se Registre Aqui' }}</h2>
        </div>
        <form action="{{ route($user->id ? 'users.update' : 'users.create', $user->id ?? [$user->id]) }}" method="POST">
            @csrf
            @method($user->id ? 'PUT' : 'POST')
            <div class="card-body bg-dark">
                @if ($user->id)
                    <div class="form-group">
                        <input type="hidden" class="form-control" data-bs-theme="dark" type="text" name="id"
                            required value="{{ $user->id }}" />
                        <input type="hidden" class="form-control" data-bs-theme="dark" type="text" name="is_admin"
                            required value="{{ $user->is_admin }}" />
                    </div>
                @endif
                <div class="form-group">
                    <label class="form-label">Nome</label>
                    <input class="form-control" data-bs-theme="dark" type="text" name="name" required
                        value="{{ old('name') ? old('name') : $user->name }}" />
                </div>
                <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input class="form-control" data-bs-theme="dark" type="email" name="email" required
                        value="{{ old('email') ? old('email') : $user->email }}" />
                </div>
                <div class="form-group">
                    <label class="form-label">CPF</label>
                    <input class="form-control" data-bs-theme="dark" type="text" name="cpf" required
                        value="{{ old('cpf') ? old('cpf') : $user->cpf }}" />
                </div>
                <div class="form-group">
                    <label class="form-label">Data de Aniversário</label>
                    <input class="form-control" data-bs-theme="dark" max="{{ $dateYearsAgo }}" type="date"
                        name="birth_date" required
                        value="{{ old('birth_date') ? old('birth_date') : $user->birth_date }}" />
                </div>
                <div class="form-group">
                    <label class="form-label">Telefone</label>
                    <input class="form-control" data-bs-theme="dark" type="phone" name="phone" required
                        value="{{ old('phone') ? old('phone') : $user->phone }}" />
                </div>

                @if ($user->id)
                    <div class="form-group">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Deseja Alterar sua
                                Senha?</label>
                            <input class="form-check-input render-password" @checked(old('show_password') ? true : false) type="checkbox"
                                name="show_password" role="switch" id="flexSwitchCheckDefault">
                        </div>
                    </div>
                    <div class="password-row">
                        <div class="password-box form-group {{ old('show_password') ? '' : 'd-none' }} ">
                            <div class="d-flex flex-row "">
                                <input class="new-password form-control" placeholder="Nova senha"
                                    type="password" name="new_password" value="{{ old('new_password') }}" />

                                <input class="password-confirmation form-control" placeholder="Confirme a senha"
                                    type="password" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}" />

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class=" img-check bi bi-check2" viewBox="0 0 16 16">
                                    <path
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0" />
                                </svg>

                            </div>

                            <input class="password form-control" placeholder="Confirme sua antiga senha" type="password"
                                name="password" value="{{ old('password') }}" />
                        </div>
                    </div>
                @else
                    <div class="password-row">
                        <div class="form-group">
                            <label class="form-label">Senha</label>
                            <input class="password form-control" data-bs-theme="dark" type="password" name="password"
                                required />
                        </div>
                        <div class="form-group">
                            <div class="d-flex flex-row"">
                                <label class="form-label">Confirme sua Senha</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="img-check bi bi-check2" viewBox="0 0 16 16">
                                    <path
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0" />
                                </svg>
                            </div>
                            <input class="password-confirmation form-control" data-bs-theme="dark" type="password"
                                name="password_confirmation" required />
                        </div>
                    </div>
                @endif


            </div>
            <div class="text-end card-footer bg-dark">
                <button class="btn-actions btn btn-light">{{ $user->id ? 'Atualizar' : 'Cadastrar' }}</button>
            </div>

        </form>
    </div>
</x-blank>
