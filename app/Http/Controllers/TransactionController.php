<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAdmin;
use Illuminate\Http\Request;
use Models\Transaction;
use Models\User;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', RedirectIfAdmin::class]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'recipient' => 'required|numeric|not_in:' . User::ADMIN_ID,
            'amount' => 'required|numeric|min:1'
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $recipient = User::findOrFail($request->get('recipient'));

        $amount = $request->get('amount');

        $transaction = Transaction::createRemittance($user, $recipient, $amount);

        return [
            'recipient_id' => $transaction->recipient->id,
            'amount' => $transaction->amount,
            'balance' => $transaction->payer_balance,
            'is_outbound' => true,
            'name' => $transaction->recipient->name,
            'performed_at' => $transaction->performed_at->format('Y-m-d H:i:s'),
        ];
    }
}
