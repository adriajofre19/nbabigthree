<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Player;
use App\Models\User;

use Inertia\Inertia;

class ClasificationController extends Controller
{
    public function index(Request $request) {
        
        $users = User::with('players')->get();

        foreach ($users as $user) {
            $user->total_points = 0;
    
            foreach ($user->players as $player) {
                // Obtener las estadísticas del jugador
                $player->stats = Player::getPlayerById($player->player_code);
    
                // Calcular los puntos totales del jugador
                $player->total_points = Player::getPointsFromThisPlayer($player->player_code);
    
                // Agregar los puntos del jugador al total del usuario
                $user->total_points += $player->total_points;
            }
        }

        $sortedUsers = $users->sortByDesc('total_points');

        return Inertia::render('Clasification', [
            'users' => $sortedUsers->values(), // Usamos values() para restablecer las claves de colección
        ]);


    }
}
