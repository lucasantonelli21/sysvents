<x-blank :container="false">

    <div class="event">

        <div class="d-flex m-5">


            <div class="left-section p-3">

                <div>
                    <div class="event-image-container rounded">
                        <img src="{{$event->image_path ? asset($event->image_path) : asset('images/default-event-image.jpeg')}}" class="rounded" alt="">
                    </div>

                </div>

                <div>
                    <p class="mb-2">Evento: {{ $event->name }}</p>
                    <p class="mb-2">Tema: {{ $event->theme }}</p>
                    <p class="mb-2">Data: {{ $event->start_date == $event->end_date ? formatDate($event->start_date,'d/m/Y')  : formatDate($event->start_date,'d/m/Y').' - '.formatDate($event->end_date,'d/m/Y') }}</p>

                    <form action="{{ route('login.authenticate') }}" action="POST">
                        @csrf

                        <input type="hidden" value="{{ $event->id }}"></input>

                        <button type="submit" class="btn ticket-button btn-primary w-100 p-2">
                            Inscrever-se
                        </button>

                    </form>

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
