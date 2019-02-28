<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\User;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'is_banned' => 'required|bool'
        ]);
        User::findOrFail($id)
            ->update(['is_banned' => $request->get('is_banned')]);
    }
}
