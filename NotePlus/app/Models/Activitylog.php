<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activitylog extends Model
{
    protected $fillable = [
        'user_id',
        'action_type', // (string: describes the type of user activity)Example values:'note_created''note_edited''note_deleted''joined_team''left_team''invited_member''transferred_ownership'
        'team_id', // nullable, if the action is related to a team
        'note_id', // nullable, if the action is related to a specific note
        'description', // e.g., 'User created a new note' Auto generated
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
