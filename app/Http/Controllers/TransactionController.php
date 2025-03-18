<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::search($request)
            ->orderBy('ts.id', 'desc')
            ->paginate($request->pagination ?? 10)
            ->withQueryString();
        return view('transactions.index', [
            'transactions' => $transactions
        ]);
    }

    public function showTransaction($id){


        $transaction = Transaction::info($id)->get();
        return view('transactions.info', [
            'transaction' => $transaction
        ]);
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