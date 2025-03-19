<x-blank >
        <div class="card bg-dark">
            <div class="card-header">
                <div class="row-title-button">
                    <a href="{{ url()->previous() }}" class="btn-back btn btn-outline-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon-large bi bi-arrow-left-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                          </svg>
                    </a>
                    <h2 class="title">Por Favor Realize Login!</h2>
                </div>
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
