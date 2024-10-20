<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\User;
use App\Models\Player;

class CrudUsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        return Inertia::render('CrudUsers', [
            'users' => $users,
        ]);
    }

    public function delete(Request $request)
    {
        
        $user = User::find($request->id);

        $user->delete();

        return redirect()->back();
    }
}
