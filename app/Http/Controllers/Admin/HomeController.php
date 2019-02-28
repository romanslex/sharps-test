<?php

namespace App\Http\Controllers\Admin;

use App\Http\Middleware\RedirectIfNotAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\Transaction;
use Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', RedirectIfNotAdmin::class]);
    }

    public function index()
    {
        $users = User::allExceptAdmin();
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
