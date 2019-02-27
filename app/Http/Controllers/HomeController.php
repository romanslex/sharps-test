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
            ->with(['outboundTransactions.recipient', 'inboundTransactions.payer'])
            ->firstOrFail();

        $users = User::all()->except($user->id);

        $viewModel = new HomeViewModel(
            $user,
            $users,
            $user->outboundTransactions,
            $user->inboundTransactions
        );
        return view('home', ['vm' => $viewModel]);
    }
}
