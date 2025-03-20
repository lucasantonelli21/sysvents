<x-blank>
    {{-- <div class="my-event-page">
        <div class="d-flex m-5">


            <div class="left-section p-3">

                <div>
                    <div class="event-image-container rounded">
                        <img src="{{ $userEvents->first()->path ? asset($userEvents->first()->path) : asset('images/default-event-image.jpeg ') }}"
                            class="rounded" alt="">
                    </div>

                </div>

                <div>
                    <p class="mb-2">Evento: {{ $userEvents->first()->event_name }}</p>
                    <p class="mb-2">Tema: {{ $userEvents->first()->event_theme }}</p>
                    <p class="mb-2">Data:
                        {{ $userEvents->first()->start_date == $userEvents->first()->end_date ? formatDate($userEvents->first()->start_date, 'd/m/Y') : formatDate($userEvents->first()->start_date, 'd/m/Y') . ' - ' . formatDate($userEvents->first()->end_date, 'd/m/Y') }}
                    </p>
                    <button id="show-tickets" class="btn ticket-button btn-success w-100 p-2">
                        Clique para ver suas reservas
                    </button>
                </div>


            </div>


            <div class="right-section d-flex flex-column">
                <div class="m-3 d-flex flex-column flex-grow-1">
                    <h2 class="text-center event-title m-0 pb-3">Sua reserva pra o Evento <span
                            class="text-info">{{ $userEvents->first()->event_name }}</span></h2>
                    <div class="reservations">
                        @foreach ($userEvents as $reservation)
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item active">
                                    <h4>Ingresso no nome de: <span
                                            class="text-dark">{{ $reservation->ticket_owner }}</span></h4>
                                </li>
                                <li class="list-group-item">
                                    <h4>Ingresso no CPF de: <span
                                            class="text-primary">{{ $reservation->ticket_owner_cpf }}</span></h4>
                                </li>
                            </ul>
                        @endforeach
                    </div>

                    <div
                        class="map bg-secondary flex-grow-1 mt-auto rounded d-flex justify-content-center align-items-center">
                        MAPA</div>


                </div>


            </div>


        </div>
    </div> --}}
    <div class="card">
        <div class="card-header">
            <div class="row-title-button">
                <a href="{{ url()->previous() }}" class="icons btn-back btn btn-outline-light">
                    <img src="{{ asset('images/icons/arrow-left-circle.svg') }}" alt="">
                </a>
                <h1 class="title">
                    Sua reserva para o Evento <span class="text-info">{{ $userEvents->first()->event_name }}</span>
                </h1>

            </div>
        </div>
        <div class="my-event-page container my-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-3">
                            <div class="card-body">
                                <img src="{{ $userEvents->first()->image_path ? asset($userEvents->first()->path) : asset('images/default-event-image.jpeg') }}"
                                    class="card-img-top rounded" alt="Evento">
                                <p><strong>Evento:</strong> {{ $userEvents->first()->event_name }}</p>
                                <p><strong>Tema:</strong> {{ $userEvents->first()->event_theme }}</p>
                                <p><strong>Data:</strong> {{ formatDate($userEvents->first()->start_date, 'd/m/Y') }} -
                                    {{ formatDate($userEvents->first()->end_date, 'd/m/Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card card-ticket p-3">
                            @foreach ($userEvents as $index => $reservation)
                                <div class="ticket">
                                    <h5><span class="text-info">Ticket #{{ $loop->iteration }}</span></h5>
                                    <ul>
                                        <li>
                                            <p><strong>Ingresso no nome de: <span
                                                        class="text-info">{{ $reservation->ticket_owner }}</span></strong>
                                            </p>
                                        </li>
                                        <li>
                                            <p><strong>Ingresso no CPF de: <span
                                                        class="text-info">{{ $reservation->ticket_owner_cpf }}</span></strong>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="map mt-5">
                    MAPA
                </div>
            </div>
        </div>
    </div>
</x-blank>
