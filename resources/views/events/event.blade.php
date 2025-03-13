<x-blank :container="false">

    <div class="event">

        <div class="d-flex m-5">


            <div class="left-section p-3">

                <div>
                    <div class="event-image-container">
                        <img src="{{ asset('images/eventfake1.jpeg') }}" class="" alt="">
                    </div>

                    <div class="mt-2">
                        <p class="mb-2">Evento: {{ $event->name }}</p>
                        <p class="mb-2">Tema: {{ $event->theme }}</p>
                        <p class="mb-2">Data: {{ $event->start_date == $event->end_date ? \Carbon\Carbon::parse($event->start_date)->format('d/m/Y')  : \Carbon\Carbon::parse($event->start_date)->format('d/m/Y').' - '.\Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</p>
                        <p class="mb-2">Botão comprar ingresso</p>
                    </div>
                </div>


            </div>


            <div class="right-section d-flex flex-column">
                <div class="m-3 d-flex flex-column flex-grow-1">
                    <h2 class="text-center event-title m-0 pb-3">{{ $event->name }}</h2>
                    <p>{{ $event->description }}</p>

                    <div class="map bg-secondary flex-grow-1 mt-auto rounded d-flex justify-content-center align-items-center">MAPA</div>


                </div>


            </div>


        </div>

    </div>

</x-blank>
