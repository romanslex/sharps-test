<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\Transaction;
use Models\User;
use mysql_xdevapi\Exception;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'recipient' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        $user = auth()->user()->firstOrFail();
        $recipient = User::findOrFail($request->get('recipient'));

        $amount = $request->get('amount');

        Transaction::createRemittance($user, $recipient, $amount);
    }
}
