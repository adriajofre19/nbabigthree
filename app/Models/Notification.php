<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'player_sent_id',
        'player_received_id',
        'status',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function playerSent()
    {
        return $this->belongsTo(Player::class, 'player_sent_id');
    }

    public function playerReceived()
    {
        return $this->belongsTo(Player::class, 'player_received_id');
    }
}
