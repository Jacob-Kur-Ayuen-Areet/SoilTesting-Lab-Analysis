<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query();

        if ($search) {
            $users->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('email', 'LIKE', '%' . $search . '%')
                  ->orWhere('phone', 'LIKE', '%' . $search . '%');
            });
        }

        $users = $users->paginate(10);

        return view('user.index', compact('users', 'search'));
    }

    public function show($id)
    {
        $user = User::with('farmer')->findOrFail($id);
        return view('user.show', compact('user'));
    }
}
