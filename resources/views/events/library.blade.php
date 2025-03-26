@php
    $paginations = [10, 15, 20, 30];

    // $themes = [
    //     'technology' => 'Tecnologia',
    //     'cultural' => 'Cultura',
    //     'musical' => 'Música',
    //     'art' => 'Arte',
    //     'sport' => 'Esportes',
    //     'gastronomy' => 'Gastronomia',
    //     'health' => 'Saúde e Bem-estar',
    // ];

@endphp

<x-blank :container=false>

    <div class="library">

        <div class="page d-flex mt-5 mx-5">
            <div class="left-section">

                <div class="mb-3 form-group">
                    <label class="form-label">Pesquisar pelo nome do evento</label>
                    <input type="text" class="form-control name-search" placeholder="Nome do evento" name="name">
                </div>

                <div class="mb-3 form-group categories-container">
                    <label class="mb-0 form-label">Pesquisar pela categoria</label>
                    @foreach ($themes as $theme)
                    <div class="form-check">
                        <input name="theme" type="checkbox" class="category-search form-check-input" id="{{ $theme }}">
                        <label for="{{ $theme }}" class="form-check-label">{{ $theme }}</label>
                    </div>

                    @endforeach

                </div>

            </div>


            <div class="right-section ms-3 p-3 w-100 d-flex justify-content-center align-items-center">

                <div class="library-container d-flex flex-wrap gap-3">

                    @foreach ($events as $event)
                        <div id="{{ 'evento'.$event->id }}" class="evento media-element rounded" data-id="{{ $event->id }}">
                            <img src="{{ $event->image_path ? Storage::disk('public')->url($event->image_path) : Storage::url('events/default-event-image.jpeg') }}" class="rounded">
                            <div class="image-overlay d-flex justify-content-center flex-column rounded">
                                <h3 class="event-title text-center">{{ $event->name }}</h3>
                                <p class="mx-2 event-description">{{ $event->description }}</p>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>

        </div>



    </div>

</x-blank>