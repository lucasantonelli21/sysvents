<x-blank :container="false">

    <div class="event">


        <div class="container d-flex h-100 bg-primary">

            <div class="event-image-container">
                <img src="{{$event->image_path ? asset($event->image_path) : asset('images/default-event-image.jpeg')}}" alt="">
            </div>




            <div class="bg-dark flex-1 flex-fill"></div>

            <div class="bg-danger flex-2 flex-fill"></div>

        </div>



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
