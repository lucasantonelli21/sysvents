<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Definindo a relação com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Definindo a relação com o modelo Ticket
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function scopeSearch($query, $request)
    {
        // Monta a query base
        $query->from('transactions as ts')
            ->join('users as u', 'u.id', '=', 'ts.user_id')
            ->join('tickets as t', 't.transaction_id', '=', 'ts.id')
            ->join('ticket_batches as tb', 'tb.id', '=', 't.ticket_batch_id')
            ->selectRaw(
                'ts.*,
                 u.name as user_name,
                 u.email as use_email,
                 COUNT(t.id) AS total_tickets'
            )
            ->groupBy('ts.id', 'u.id','u.name','u.email');
        // Aplica filtros se existirem
        if ($request->name) {
            $query->where('u.name', 'ilike', '%'.$request->name.'%');
        }

        if ($request->email) {
            $query->where('u.email', 'ilike', '%'.$request->email.'%');
        }

        if ($request->ticket_amount) {
            $query->havingRaw('COUNT(t.id) = ?', [$request->ticket_amount]);
        }

        if($request->amount){
            $query->where('ts.amount', $request->amount);
        }

        return $query;
    }


    public function scopeInfo($query, $transactionId)
    {
        $query->from('transactions as ts')
            ->join('users as u', 'u.id', '=', 'ts.user_id')
            ->join('tickets as t', 't.transaction_id', '=', 'ts.id')
            ->join('ticket_batches as tb', 'tb.id', '=', 't.ticket_batch_id')
            ->join('ticket_types as tp', 'tp.id', '=', 'tb.ticket_type_id')
            ->join('events as e', 'e.id', '=', 'tp.event_id')
            ->selectRaw(
                'ts.id as id,
                 ts.amount as amount,
                 ts.created_at as date,
                 u.name as user_name,
                 u.email as user_email,
                 tb.name as ticket_batch_name, tb.batch as ticket_batch,
                 tb.price as ticket_price,
                 t.id as ticket_id, t.owner_name as ticket_owner_name, t.owner_cpf as ticket_owner_cpf,
                 tp.name as ticket_type_name,
                 e.name as event_name'
            )
            ->where('ts.id', $transactionId)
            ->groupBy(
                'ts.id',
                'u.id',
                'u.name',
                'u.email',
                't.id',
                'tb.id',
                'tb.name',
                'tb.price',
                'tp.name',
                'e.name'
            );
        return $query;
    }

}
