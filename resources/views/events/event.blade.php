<x-blank :container="false">

    <div class="event">

        <div class="d-flex m-5">


            <div class="left-section bg-dark p-3">

                <div>
                    <div class="event-image-container">
                        <img src="{{ asset('images/eventfake1.jpeg') }}" class="" alt="">
                    </div>

                    <p>Evento: {{ $event->name }}</p>
                    <p>Tema: {{ $event->theme }}</p>
                    <p>Data: {{ $event->start_date == $event->end_date ? \Carbon\Carbon::parse($event->start_date)->format('d/m/Y')  : \Carbon\Carbon::parse($event->start_date)->format('d/m/Y').' - '.\Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</p>
                    <p>Botão comprar ingresso</p>
                </div>


            </div>


            <div class="right-section bg-dark d-flex flex-column">
                <div class="m-3 d-flex flex-column flex-grow-1">
                    <h2 class="text-center event-title m-0 pb-3">{{ $event->name }}</h2>
                    <p>{{ $event->description }}</p>

                    <div class="map bg-secondary flex-grow-1 mt-auto rounded d-flex justify-content-center align-items-center">MAPA</div>


                </div>


            </div>


        </div>







        {{-- <div class="bg-dark flex-grow-1"></div>

        <div class="bg-danger flex-grow-1"></div>

        <div class="container d-flex h-100 bg-primary">


        </div> --}}



        {{-- <div>

                <div class="ratio ratio-1x1">

                    <img src="{{ asset('images/eventfake1.jpeg') }}" class="" alt="">
                </div>

                <img src="{{$event->image_path ? asset($event->image_path) : asset('images/default-event-image.jpeg')}}" alt="">
                <h1>

                    {{ $event->name }}
                </h1>

                <p>

                    {{ $event->description }}
                </p>
            </div> --}}
    </div>

</x-blank>
