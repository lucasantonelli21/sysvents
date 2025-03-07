<x-blank>

    <div class="card bg-dark">
        <div class="card-header">
            <h2 class="title text-center">Por Favor Realize Login!</h2>
        </div>
        <form action="{{ route('login.authenticate') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input class="form-control" data-bs-theme="dark" type="email" name="email" required value="{{ old('email') }}" />
                </div>
                <div class="form-group">
                    <label class="form-label">Senha</label>
                    <input class="form-control" data-bs-theme="dark" type="password" name="password" required
                        value="{{ old('password') }}" />
                </div>
            </div>
            <div class="card-footer text-end">
                <button class="btn-actions btn btn-light" type="submit">Logar</button>
            </div>
        </form>
    </div>

</x-blank>
