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

}
