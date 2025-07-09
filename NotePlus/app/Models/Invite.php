<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'member_name', // Name of the invited member
        'title', // Web Developer, etc.
        'role', //
        'team_id',
        'code', // Unique
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
}
