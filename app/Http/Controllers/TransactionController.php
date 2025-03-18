<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::with(['user', 'tickets'])
        ->orderBy('id', 'desc')
        ->paginate($request->pagination ?? 10);


    return view('transactions.index', [
        'transactions' => $transactions
    ]);


        // $transactions = Transaction::find(1)->tickets()
        //     ->orderBy('id', 'desc')
        //     ->paginate($request->pagination ?? 10);

        // dd($transactions->all());
        // return view('transactions.index', [
        //     'transactions' => $transactions
        // ]);
    }
    public function delete($id)
    {
        try {
            $event = Transaction::find($id);
            if ($event == null) {
                return redirect()->route('panel.transactions.index')->withErrors("Erro ao deletar a transação");
            } else {
                $event->delete();
                return redirect()->route('panel.transactions.index')->withSuccess("Transação deletada com sucesso!");
            }
        } catch (\Throwable $th) {
        }
    }
}
// $transactions = Transaction::select('transactions.*', 'users.name', 'users.email', 'tickets.id')
// ->leftJoin('users', 'transactions.user_id', 'users.id')
// ->leftJoin('tickets', 'transactions.id', 'tickets.transaction_id')
// ->orderBy('transactions.id', 'desc')
// ->paginate($request->pagination ?? 10);
// dd($transactions->all());
// return view('transactions.index', [
// 'transactions' => $transactions
// ]);