@php

    $messagesError = session('errors')?->getMessages();
    $messagesSuccess = session('success');

@endphp

@if ($messagesError)

    <div class="alert alert-danger" role="alert">

        @foreach ($messagesError as $message)
            {{ $message[0] }} <br>
        @endforeach

    </div>

@endif

@if ($messagesSuccess)

    <div class="alert alert-success" role="alert">
        {{ $messagesSuccess }}
    </div>

@endif
