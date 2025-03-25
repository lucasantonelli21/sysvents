<x-blank>

    <div class="card">
        <div class="card-header">
            <div class="row-title-button">
                <a href="{{ url()->previous() }}" class="icons btn-back btn btn-outline-light">
                   <img src="{{ asset('images/icons/arrow-left-circle.svg') }}" alt="">
                </a>
                <h1 class = "title text-center">Enviar email para: {{ $user->name }}</h1>
            </div>
        </div>
        <form class="form" action="{{ route('panel.users.sendEmail', $user->id) }}" method="post">
            @csrf
            <div class="card-body">
                    <input type="hidden" class="form-control" data-bs-theme="dark" type="text" name="email"
                        required value="{{ $user->email }}" />
                <div class="form-group ">
                    <textarea rows="9" cols="50" class="form-control w-100" type="text" name="emailText" id="emailText"
                        required> </textarea>
                </div>
                <div class="card-footer text-end">
                    <button class="btn-actions btn btn-light">{{ 'Enviar' }}</button>
                </div>
            </div>
    </div>

</x-blank>
