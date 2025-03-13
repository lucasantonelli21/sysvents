@php

    $messagesError = session('errors')?->getMessages();
    $messagesSuccess = session('success');

@endphp

@if ($messagesError)


    <div class="alert alert-danger d-flex align-items-center mx-3" role="alert">
        <div class="me-2">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <div>
            @foreach ($messagesError as $message)
                {{ $message[0] }} <br>
            @endforeach
        </div>
    </div>

@endif

@if ($messagesSuccess)
    <div class="alert alert-success d-flex align-items-center mx-3" role="alert">
        <div class="me-2">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div>
            {{ $messagesSuccess }}
        </div>
    </div>
@endif
