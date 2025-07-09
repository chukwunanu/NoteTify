<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Team;

class TeamUser extends Model
{
    protected $table = 'team_users';

    protected $fillable = [
        'user_id',
        'team_id',
        'role', // (owner/member)
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }


}
