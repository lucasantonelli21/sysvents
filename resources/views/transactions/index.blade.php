@php
    $paginations = [10, 15, 20, 30];
@endphp
<x-blank>

    <div class="index-pages card">
        <div class="card-header text-light">
            <div class="card-row">
                <div class="select-pagination">
                    <form class="form-pagination" action="{{ route('panel.transactions.index') }}">
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
                <h2 class="title text-center">Transações</h2>
                <div class="modal-card">

                    <button type="button" class="filter icons btn btn-outline-light" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <img src="{{ asset('images/icons/filter.svg') }}" alt="">
                    </button>
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
                            <form class="form-filter" action="{{ route('panel.transactions.index') }}">
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="form-label">Nome</label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ Request::get('name') }}" />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">E-mail</label>
                                            <input class="form-control" type="text" name="email"
                                                value="{{ Request::get('email') }}" />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Quantidade de Ingressos</label>
                                            <input class="form-control" type="number" name="ticket_amount"
                                                value="{{ Request::get('ticket_amount') }}" />
                                        </div>


                                        <div class="form-group">
                                            <label class="form-label">Preço</label>
                                            <input class="form-control" type="number" name="amount"
                                                value="{{ Request::get('amount') }}" />
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-light"
                                            href="{{ route('panel.transactions.index') }}">Limpar
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
                    <th>ID da compra</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Valor Total</th>
                    <th>Tickets</th>
                    <th>Deletar</th>
                </tr>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>{{ $transaction->user->email }}</td>
                        <td>R${{ $transaction->amount }}</td>
                        <td>{{ $transaction->total_tickets }}</td>
                        <td>
                            <div class= "table-buttons">
                                <a href="{{ route('panel.transactions.show', [$transaction->id]) }}"
                                    class="icons btn btn-outline-primary">
                                    <img  src="{{ asset('images/icons/search.svg') }}" alt="">
                                </a>
                                <form action="{{ route('panel.transactions.delete', [$transaction->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icons btn btn-outline-danger">
                                        <img src="{{ asset('images/icons/trash.svg') }}" alt="">
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
    </div>
    <div class="card-footer text-end">
        {{ $transactions->links() }}
    </div>
    </div>

</x-blank>
