<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\Transaction;
use Models\User;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'recipient' => 'required|numeric',
            'amount' => 'required|numeric|min:1'
        ]);

        $user = auth()->user()->firstOrFail();
        $recipient = User::findOrFail($request->get('recipient'));

        $amount = $request->get('amount');

        $transaction = Transaction::createRemittance($user, $recipient, $amount);

        return [
            'amount' => $transaction->amount,
            'balance' => $transaction->payer_balance,
            'is_outbound' => true,
            'name' => $transaction->recipient->name,
            'performed_at' => $transaction->performed_at->format('Y-m-d H:i:s'),
        ];
    }
}
