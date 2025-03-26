@php
    $paginations = [10, 15, 20, 30];

@endphp

<x-blank :container=false>

    <div class="library">

        <h1 class="title text-center mt-5">Reservas de <span class="text-info">{{$userEvents->first()->name}}</span></h1>
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

                    @foreach ($userEvents as $userEvent)
                        <div id="{{ 'evento'.$userEvent->event_id }}" class="evento media-element rounded" data-id="{{ $userEvent->event_id }}">
                            <img src="{{ $userEvent->path ? Storage::disk('public')->url($userEvent->path) : Storage::url('events/default-event-image.jpeg') }}" class="rounded">
                            <div class="image-overlay d-flex justify-content-center flex-column rounded">
                                <h3 class="event-title text-center">{{ $userEvent->event_name }}</h3>
                                <p class="mx-2 event-description">{{ $userEvent->event_description }}</p>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>

        </div>



    </div>

</x-blank>
