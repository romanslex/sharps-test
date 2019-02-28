<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.home', ['users' => $users]);
    }
}
