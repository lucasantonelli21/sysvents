<x-blank>


    <div class="card">
        <div class="card-header">
            <h2 class="text-center"> Ingressos da Transação de <span class="text-primary">Id
                    {{ $transaction->first()->id }}</span> de <span
                    class="text-info">{{ $transaction->first()->user_name }}</span></h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped custom-table">
                    <tr>
                        <th>Ticket</th>
                        <th>Nome do Dono</th>
                        <th>CPF do Dono</th>
                        <th>Evento</th>
                        <th>Tipo de Ingresso</th>
                        <th>Nome do Lote</th>
                        <th>Número do Lote</th>
                        <th>Preço Do Ingresso</th>
                        <th>Comprado Em</th>
                    </tr>

                    @foreach ($transaction as $trans)
                        <tr>
                            <td>#{{ $trans->ticket_id }}</td>
                            <td>{{ $trans->ticket_owner_name }}</td>
                            <td>{{ $trans->ticket_owner_cpf }}</td>
                            <td>{{ $trans->event_name }}</td>
                            <td>{{ $trans->ticket_type_name }}</td>
                            <td>{{ $trans->ticket_batch_name }}</td>
                            <td>#{{ $trans->ticket_batch }}</td>
                            <td>R${{ $trans->ticket_price }}</td>
                            <td>{{ formatDate($trans->date,'d/m/Y') }} </td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>

</x-blank>
