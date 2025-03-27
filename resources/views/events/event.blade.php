<x-blank :container="false">

    <div class="event page-maps">

        <div class="d-flex m-5">


            <div class="left-section p-3">

                <div>
                    <div class="event-image-container rounded">
                        <img src="{{ $event->image_path ? asset($event->image_path) : asset('images/default-event-image.jpeg') }}"
                            class="rounded" alt="">
                    </div>
                </div>

                <div>
                    <p class="mb-2">Evento: {{ $event->name }}</p>
                    <p class="mb-2">Tema: {{ $event->theme }}</p>
                    <p class="mb-2">Data:
                        {{ $event->start_date == $event->end_date ? formatDate($event->start_date, 'd/m/Y') : formatDate($event->start_date, 'd/m/Y') . ' - ' . formatDate($event->end_date, 'd/m/Y') }}
                    </p>

                    <button class="mt-2 btn schedule-button btn-primary w-100 p-2">Agendar</button>
                    <input class="event-date" type="hidden" value="{{ $event->start_date }}">

                </div>


            </div>


            <div class="right-section d-flex flex-column">
                <div class="m-3 d-flex flex-column flex-grow-1">
                    <h2 class="text-center event-title m-0 pb-3">{{ $event->name }}</h2>

                    <div class="d-flex gap-2 mb-5">
                        <div class="ticket-types-container w-50 border-right px-5">
                            <h4>Tipos de ingressos:</h4>

                            {{-- Se não encontrar os ingressos, isso pode ocorrer por exemplo quando um evento está com um "batch" que na verdade não existe --}}
                            @if (count($ticket_types) == 0)
                            <p class="text-warning">Não foi possível mostrar as informações de ingressos para esse evento, por favor tente novamente mais tarde ou entre em contato conosco.</p>
                            @else
                            <table class="table table-responsive table-hover">
                                <tr class="">
                                    <th class="p-3 px-5 text-center">Tipos</th>
                                    <th class="p-3 px-5 text-center">Quantidade</th>
                                    <th class="p-3 px-5 text-center">Valor</th>

                                </tr>

                                @foreach($ticket_types as $ticket_type)
                                <tr>
                                    <td class="align-content-center p-4">
                                        <div>
                                            <label for="" class="">{{ $ticket_type->name }}</label>
                                        </div>
                                    </td>
                                    <td class="justify-content-center align-content-center">
                                        <div class="ticket-amount-container">
                                            <input type="number" class="amount-input form-control mb-0" value=0 min=0 max=20 data-ticket-type-id="{{  $ticket_type->id }}"></input>
                                        </div>

                                    </td>
                                    <td class="text-center align-content-center {{ "price-".$ticket_type->id }}">{{ $ticket_type->price }}</td>
                                </tr>


                                @endforeach
                                <tfoot>
                                    <tr>
                                        <td class="text-center">Total:</td>
                                        <td class="tickets-total-amount text-center">0</td>
                                        <td class="tickets-total-price text-center">0,00</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <form action="{{ url('/eventos/inscrição') }}" method="POST">
                                @csrf

                                <input name="event_id" type="hidden" value="{{ $event->id }}"></input>

                                <div class="d-flex justify-content-end">

                                    @if ($is_subscribed)
                                    <button type="submit" class="btn disabled ticket-button btn-primary p-2">
                                        Comprou
                                    </button>
                                    @else
                                    <button type="submit" class="btn ticket-button btn-primary w-100 p-2">
                                        Comprar
                                    </button>
                                    @endif
                                </div>

                            </form>
                            @endif


                        </div>

                        <div class="divider h-100"></div>

                        <div class="description-container w-50 px-4">
                            <h4>Descrição:</h4>
                            <p class="event-description">{{ $event->description }}</p>
                        </div>

                    </div>

                    <div class="map bg-secondary flex-grow-1 mt-auto rounded d-flex justify-content-center align-items-center">
                    </div>

                    <div class="events d-none" data-events="{{ $event }}"></div>
                </div>


            </div>


        </div>

    </div>

</x-blank>
