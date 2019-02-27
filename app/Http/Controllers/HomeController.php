<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()
            ->user()
            ->with(['outboundTransactions.recipient', 'inboundTransactions'])
            ->firstOrFail();

        $outboundTransactions = $user->outboundTransactions->map(function ($item) {
            return [
                'performed_at' => $item->performed_at->format('Y-m-d H:i'),
                'name' => $item->recipient->name,
                'amount' => $item->amount,
                'balance' => 0
            ];
        });

        $inboundTransactions = $user->inboundTransactions->map(function ($item) use ($user) {
            return [
                'performed_at' => $item->performed_at->format('Y-m-d H:i'),
                'name' => $user->name,
                'amount' => $item->amount,
                'balance' => 0
            ];
        });
        $transactions = $inboundTransactions->merge($outboundTransactions);
        return view('home', ['transactions' => $transactions]);
    }
}
