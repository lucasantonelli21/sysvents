<x-blank :container="false">

    <div class="event">

        <div class="d-flex border border-success">


            <div class="left-section bg-dark p-2">


                <div class="event-image-container">
                    <img src="{{ asset('images/eventfake1.jpeg') }}" class="" alt="">
                </div>


            </div>


            <div class="right-section bg-dark">
                <div class="m-2">
                    <h2 class="text-center event-title m-0 pb-3">{{ $event->name }}</h2>
                    <p>{{ $event->description }}</p>

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
