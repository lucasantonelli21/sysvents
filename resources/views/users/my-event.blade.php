<x-blank :container="false">
    <div class="my-event-page">
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
                    <div class="reservations d-none">
                        @foreach ($userEvents as $reservation )
                            <h4>Ingresso no nome de: <span class="text-primary">{{$reservation->ticket_owner}}</span></h4>
                            <h4>Ingresso no CPF de: <span class="text-primary">{{$reservation->ticket_owner_cpf}}</span></h4>
                            <br>
                        @endforeach
                    </div>
                    <p class="description">{{ $userEvents->first()->event_description }}</p>

                    <div
                        class="map bg-secondary flex-grow-1 mt-auto rounded d-flex justify-content-center align-items-center">
                        MAPA</div>


                </div>


            </div>


        </div>
    </div>

</x-blank>
