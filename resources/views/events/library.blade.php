@php
    $paginations = [10, 15, 20, 30];

    $themes = [
        'technology' => 'Tecnologia',
        'cultural' => 'Cultura',
        'musical' => 'Música',
        'art' => 'Arte',
        'sport' => 'Esportes',
        'gastronomy' => 'Gastronomia',
        'health' => 'Saúde e Bem-estar',
    ];

@endphp

<x-blank :container=false>

    <div class="library">

        <div class="page d-flex mt-5 mx-5">
            <div class="left-section">

                <form action="">

                    <div class="mb-3">
                        <label for="" class="form-label">Pesquisar pelo nome do evento</label>
                        <input type="text" class="form-control" placeholder="Nome do evento">
                    </div>

                    <div class="mb-3">
                        <label class="mb-0 form-label">Pesquisar pela categoria</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="{{ $themes['technology'] }}">
                            <label for="{{ $themes['technology'] }}" class="form-check-label">{{ $themes['technology'] }}</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="{{ $themes['cultural'] }}">
                            <label for="{{ $themes['cultural'] }}" class="form-check-label">{{ $themes['cultural'] }}</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="{{ $themes['musical'] }}">
                            <label for="{{ $themes['musical'] }}" class="form-check-label">{{ $themes['musical'] }}</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="{{ $themes['art'] }}">
                            <label for="{{ $themes['art'] }}" class="form-check-label">{{ $themes['art'] }}</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="{{ $themes['sport'] }}">
                            <label for="{{ $themes['sport'] }}" class="form-check-label">{{ $themes['sport'] }}</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="{{ $themes['gastronomy'] }}">
                            <label for="{{ $themes['gastronomy'] }}" class="form-check-label">{{ $themes['gastronomy'] }}</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="{{ $themes['health'] }}">
                            <label for="{{ $themes['health'] }}" class="form-check-label">{{ $themes['health'] }}</label>
                        </div>

                        <label for="" class=></label>
                    </div>

                </form>

            </div>


            <div class="right-section ms-3 p-3">

                <div class="d-flex justify-content-between flex-wrap gap-3">
                    @foreach ($events as $event)
                        <div class="media-element mb-1 rounded" href="{{ url('eventos/'.$event->id) }}">
                            <img src="{{$event->image_path ? asset($event->image_path) : asset('images/default-event-image.jpeg')}}" class="rounded">
                            <div class="image-overlay d-flex justify-content-center flex-column rounded">
                                <h2 class="event-title text-center">{{ $event->name }}</h2>
                                <p class="mx-2 event-description">{{ $event->description }}</p>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>

        </div>



    </div>

</x-blank>