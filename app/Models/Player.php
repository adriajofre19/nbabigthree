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

    public static function getInfoFromThisPlayer($player_code)
    {
        $stats = self::getAllInfoFromTheApi();
        
        $stats = collect($stats)->where('player', $player_code);

        $totalPoints = $stats->sum('game_score');

        return $totalPoints;
    }

    public static function getInfoFromThisPlayerByThisWeek($player_code){
        $stats = self::getAllInfoFromTheApi();

        $today = date('Y-m-d');
        $startWeek = date('Y-m-d', strtotime('last monday', strtotime($today)));
        $endWeek = date('Y-m-d', strtotime('next sunday', strtotime($today)));

        $stats = collect($stats)->where('player', $player_code)->whereBetween('date', [$startWeek, $endWeek]);

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
