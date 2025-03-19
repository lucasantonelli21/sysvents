<x-blank>
    <h1 class="title text-center">Estes são seus eventos <span
            class="text-primary">{{ $userEvents->first()->name }}</span></h1>

    <div class="user-events">
        <div class="events-container mt-5">
            <div class="media-scroller d-flex gap-3">
                @foreach ($userEvents as $userEvent)
                    <a class="media-element mb-1 rounded"
                        href="{{ route('users.event', [$userEvent->id, $userEvent->event_id]) }}">
                        <img src="{{ $userEvent->image_path ? asset($userEvent->path) : asset('images/default-event-image.jpeg') }}"
                            class="rounded">
                        <div class="image-overlay d-flex justify-content-center flex-column rounded">
                            <h2 class="event-title text-center">{{ $userEvent->event_name }}</h2>
                            <h6 class="text-light text-center">Dos dias <span
                                    class="text-info">{{ formatDate($userEvent->start_date, 'd/m/Y') }}</span> Até
                                <span class="text-info">{{ formatDate($userEvent->end_date, 'd/m/Y') }}</span>
                            </h6>
                            <p class="mx-2 event-description">{{ $userEvent->event_description }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

</x-blank>
