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

    public function update (Request $request)
    {
        
        $titular_id = $request->titular_id;
        $suplent_id = $request->suplent_id;

        $titular = Player::find($titular_id);
        $suplent = Player::find($suplent_id);

        $titular->update([
            'role' => 'suplente',
        ]);

        $suplent->update([
            'role' => 'titular',
        ]);

        
    }

}
