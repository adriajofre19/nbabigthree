<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Player;
use App\Models\User;

use Inertia\Inertia;

class PlayersController extends Controller
{
    public function index(Request $request)
    {
        $players = Player::where('user_id', $request->user()->id)->get();

        return Inertia::render('MyTeam', [
            'players' => $players,
        ]);
    }

}
