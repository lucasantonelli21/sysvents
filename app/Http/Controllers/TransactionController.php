<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::select('transactions.*', 'users.name', 'users.email')
        ->leftJoin('users', 'transactions.user_id', 'users.id')
        ->orderBy('transactions.id', 'desc')
        ->paginate($request->pagination ?? 10);
        return view('transactions.index', [
            'transactions' => $transactions
        ]);
    }
}