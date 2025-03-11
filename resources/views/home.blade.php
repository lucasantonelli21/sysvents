<x-blank :container="false">

    <div class="home pt-5">

        <div class="text-center">

            <div>
                <h1 class="title">Bem-vindo à Sysvents</h1>
            </div>

            <div class="mb-5">
                <h2 class="subtitle">Conectando você aos melhores eventos -
                    <span>Descubra</span>,
                    <span>viva</span>,
                    <span>aproveite</span>
                </h2>
            </div>

            <div class="">
                <img src="{{ asset('images/evento-image.webp') }}" class="event-image rounded">
            </div>


        </div>


        <div class="mt-5 container">
            <h2>Sobre nós</h2>
            <h4>A Sysvents é uma empresa focada em conectar pessoas a experiências únicas por meio de uma plataforma
                eficiente de divulgação e compra de ingressos para eventos.</h4>
        </div>



        <div class="events-container mt-5">
            <div class="text-center">
                <h2>Eventos</h2>
            </div>



            <div class="media-scroller d-flex gap-3">

                @foreach ($events as $event)
                <div class="media-element rounded">
                    <img src="{{$event->img ? asset(` $event->img `) : asset('images/default-event-image.jpeg')}}" class="rounded">
                    <div class="image-overlay d-flex justify-content-center flex-column">
                        <h2 class="event-title text-center">{{ $event->name }}</h2>
                        <p class="mx-2 event-description">{{ $event->description }}</p>
                    </div>
                </div>
                @endforeach


            </div>

        </div>


    </div>

</x-blank>
