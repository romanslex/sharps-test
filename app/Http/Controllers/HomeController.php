<?php

namespace App\Http\Controllers;

use App\ViewModels\HomeViewModel;
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

        $viewModel = new HomeViewModel(
            $user,
            $user->outboundTransactions,
            $user->inboundTransactions
        );
        return view('home', ['vm' => $viewModel]);
    }
}
