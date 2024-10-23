<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Player;
use App\Models\User;

use Inertia\Inertia;

class ClasificationController extends Controller
{
    public function index(Request $request) {
        
        $users = User::all();

        foreach ($users as $user) {

            $user->players = Player::where('user_id', $user->id)->get();

            $user->total_points = 0;
            
            foreach ($user->players as $player) {
                
                $player->stats = Player::getPlayerById($player->player_code);

                $player->total_points = 0;

                foreach ($player->stats as $stat) {
                    $player->total_points += $stat['game_score'];
                }

                $user->total_points += $player->total_points;
            }
        }

        // order by total points
        $users = $users->sortByDesc('total_points');

        return Inertia::render('Clasification', [
            'users' => $users,
        ]);


    }
}
