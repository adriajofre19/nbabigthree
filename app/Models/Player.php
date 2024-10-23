<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Player extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'avatar',
        'position',
        'team',
        'price',
        'role',
        'stats',
        'player_code',
        'user_id',
    ];

    protected $casts = [
        'stats' => 'array',
    ];

    /**
     * Get the user that owns the player.
     */
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getAllInfoFromTheApi(): array
    {
        $stats = file_get_contents('Players.json');
        return json_decode($stats, true);
    }

    public static function getPointsFromThisPlayer($player_code)
{
    $stats = self::getAllInfoFromTheApi();
    $totalPoints = 0;

    foreach ($stats as $game) {
        if ($game['player'] === $player_code) {
            $totalPoints += $game['field_goals'] * 2; // Cada field_goal suma 2 puntos
            $totalPoints -= $game['field_goals_attempted']; // Cada field_goal_attempted resta 1 punto
            $totalPoints += $game['three_point_field_goals']; // Cada three_point_field_goal suma 1 punto
            $totalPoints += $game['free_throws']; // Cada free_throw suma 1 punto
            $totalPoints -= $game['free_throws_attempted']; // Cada free_throw_attempted resta 1 punto
            $totalPoints += $game['total_rebounds']; // Cada total_rebound suma 1 punto
            $totalPoints += $game['assists'] * 2; // Cada assist suma 2 puntos
            $totalPoints += $game['steals'] * 4; // Cada steal suma 4 puntos
            $totalPoints += $game['blocks'] * 4; // Cada block suma 4 puntos
            $totalPoints -= $game['turnovers'] * 2; // Cada turnover resta 2 puntos
            $totalPoints += $game['points']; // Cada punto suma 1 punto
        }
    }

    return $totalPoints;
}

public static function getPointsFromThisPlayerOnThisWeek($player_code)
{
    $stats = self::getAllInfoFromTheApi();
    $totalPoints = 0;

    $today = date('Y-m-d');
    $startWeek = date('Y-m-d', strtotime('last monday', strtotime($today)));
    $endWeek = date('Y-m-d', strtotime('next sunday', strtotime($today)));

    foreach ($stats as $game) {
        if ($game['player'] === $player_code && $game['date'] >= $startWeek && $game['date'] <= $endWeek) {
            $totalPoints += $game['field_goals'] * 2; // Cada field_goal suma 2 puntos
            $totalPoints -= $game['field_goals_attempted']; // Cada field_goal_attempted resta 1 punto
            $totalPoints += $game['three_point_field_goals']; // Cada three_point_field_goal suma 1 punto
            $totalPoints += $game['free_throws']; // Cada free_throw suma 1 punto
            $totalPoints -= $game['free_throws_attempted']; // Cada free_throw_attempted resta 1 punto
            $totalPoints += $game['total_rebounds']; // Cada total_rebound suma 1 punto
            $totalPoints += $game['assists'] * 2; // Cada assist suma 2 puntos
            $totalPoints += $game['steals'] * 4; // Cada steal suma 4 puntos
            $totalPoints += $game['blocks'] * 4; // Cada block suma 4 puntos
            $totalPoints -= $game['turnovers'] * 2; // Cada turnover resta 2 puntos
            $totalPoints += $game['points']; // Cada punto suma 1 punto
        }
    }

    return $totalPoints;
}

    public static function getInfoFromThisPlayer($player_code)
    {
        $stats = self::getAllInfoFromTheApi();
        
        $stats = collect($stats)->where('player', $player_code);

        $totalPoints = $stats->sum('game_score');

        return $totalPoints;
    }


    public static function getPlayerById($player_code)
    {
        $stats = self::getAllInfoFromTheApi();
        
        $stats = collect($stats)->where('player', $player_code);

        $totalPoints = $stats->sum('game_score');

        return $stats;
    }

    

}
