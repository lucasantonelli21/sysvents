<x-blank>
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
                                <img src="{{$userEvents->first()->path ? asset($userEvents->first()->path) : asset('images/default-event-image.jpeg')}}" class="rounded img-fluid">
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
