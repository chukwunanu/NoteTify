<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'team_name',
        'user_id',
        'created_by',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'team_users', 'team_id', 'user_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function invites()
    {
        return $this->hasMany(Invite::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(Activitylog::class);
    }
}
