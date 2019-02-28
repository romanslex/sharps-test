<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\Transaction;
use Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        $transactions = Transaction::with(['payer', 'recipient'])
            ->get()
            ->map(function ($item) {
                return [
                    'payer' => $item->payer->name,
                    'recipient' => $item->recipient->name,
                    'amount' => $item->amount,
                    'performed_at' => $item->performed_at->format('Y-m-d H:i:s'),
                ];
            });

        return view('admin.home', [
            'users' => $users,
            'transactions' => $transactions
        ]);
    }
}
