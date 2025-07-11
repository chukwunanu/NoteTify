<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'team_id',
        'email', // Unique
        'token',
        'accepted',
        'expires_at', // DateTime
        'user_id', //nullable fk
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function invitedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function generateCode()
    {
        return Str::random(5); 
    }
}
