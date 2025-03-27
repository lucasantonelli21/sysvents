 @php
    $paginations = [10, 15, 20, 30];
    use App\Enums\Themes;

@endphp
<x-blank>

    <div class="index-pages card">
        <div class="card-header text-light">
            <div class="card-row">
                <div class="select-pagination">
                    <form class="form-pagination" action="{{ route('panel.events.index') }}">
                        <a href="{{ url()->previous() }}" class="icons btn-back btn btn-outline-light">
                            <img src="{{ asset('images/icons/arrow-left-circle.svg') }}" alt="">
                        </a>
                        <select class="paginator-selector" name="pagination">
                            @foreach ($paginations as $value)
                                <option {{ $value == request()->pagination ? 'selected' : '' }}
                                    value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>


                <h2 class="title text-center">Eventos</h2>

                <div class="modal-card">

                    <button type="button" class="filter icons btn btn-outline-light" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <img src="{{ asset('images/icons/filter.svg') }}" alt="">
                    </button>

                    <a href="{{ route('panel.events.create') }}" class="icons btn btn-outline-primary">
                        <img src="{{ asset('images/icons/plus.svg') }}" alt="">
                    </a>


                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Selecione seus filtros</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="form-filter" action="{{ route('panel.events.index') }}">
                                <div class="modal-body">theme
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="form-label">Nome</label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ Request::get('name') }}" />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Tema</label>
                                            <select class="form-control" name="theme">
                                                <option value="">Selecione uma opção</option>

                                                @foreach (Themes::cases() as $value)
                                                    <option {{ Request::get('theme') == $value->value ? 'selected' : '' }}
                                                        value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-light"
                                            href="{{ route('panel.events.index') }}">Limpar
                                            Filtro</a>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Filtrar</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-body ">
        <div class="table-responsive ">
            <table class="table table-striped custom-table">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Tema</th>
                    <th>Descrição</th>
                    <th>Gratuito</th>
                    <th>Início</th>
                    <th>Fim</th>
                    {{-- <th>Longitude</th>
                    <th>Latitude</th> --}}
                    <th>Lote</th>
                    <th>Criado em</th>
                    <th>Editado em</th>
                    <th>Ações</th>
                </tr>
                @foreach ($events as $event)
                    <tr>
                        <th>{{ $event->id }}</th>
                        <td class='name-cell'>{{ $event->name }}</td>
                        <td class="themes-cell">{{ $event->theme }}</td>
                        <td class='description-cell'>Clica aqui</td>
                        <td>{{ $event->is_free ? 'Sim' : 'Não' }}</td>
                        <td>{{ formatDate($event->start_date, 'd/m/Y') }}</td>
                        <td>{{ formatDate($event->end_date, 'd/m/Y') }}</td>
                        <td>{{ $event->batch }}</td>
                        <td>{{ formatDate($event->created_at, 'd/m/Y') }}</td>
                        <td>{{ formatDate($event->updated_at, 'd/m/Y') }}</td>
                        <td>
                            <div class= "table-buttons">
                                <a href="{{ route('panel.events.edit', $event->id) }}" class="icons btn btn-outline-info">
                                    <img src="{{ asset('images/icons/pen.svg') }}" alt="">
                                </a>
                                <form action="{{ route('panel.events.delete', $event->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icons btn btn-outline-danger">
                                       <img src="{{ asset('images/icons/trash.svg') }}" alt="">
                                    </button>
                                </form>
                                <a href="{{ route('panel.events.tickets.types.index', $event->id) }}"
                                    class="icons btn btn-outline-warning">
                                    <img src="{{ asset('images/icons/ticket.svg') }}" alt="">
                                </a>
                                <a href="{{ route('panel.events.tickets.index', $event->id) }}"
                                    class="icons btn btn-outline-success">
                                   <img src="{{ asset('images/icons/wallet.svg') }}" alt="">
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
    <div class="card-footer text-end">
        {{ $events->links() }}
    </div>
    </div>

</x-blank>
