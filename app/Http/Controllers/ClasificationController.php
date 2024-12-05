<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Player;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use Inertia\Inertia;

class ClasificationController extends Controller
{
    public function index(Request $request) {
        
        $users = User::with('players')->get();

        foreach ($users as $user) {
            
            $user->total_points = 0;
    
            foreach ($user->players as $player) {
                
                $player->total_points = Player::getPointsFromThisPlayerIfPlayerIsTitular($player->player_code);

                $user->total_points += $player->total_points;
            }
        }

        $sortedUsers = $users->sortByDesc('total_points');

        $id = Auth::id();
        return Inertia::render('Clasification', [
            'users' => $sortedUsers->values(),
            'id' => $id,
        ]);
    }

    public function indexForWeek(Request $request) {
        
        $users = User::with('players')->get();

        foreach ($users as $user) {
            
            $user->total_points = 0;
    
            foreach ($user->players as $player) {
                
                $player->total_points = Player::getPointsFromThisPlayerIfPlayerIsTitularThisWeek($player->player_code);

                $user->total_points += $player->total_points;
            }
        }

        $sortedUsers = $users->sortByDesc('total_points');
        $id = Auth::id();
        return Inertia::render('ClasificationForWeek', [
            'users' => $sortedUsers->values(),
            'id' => $id,
        ]);
    }


}
