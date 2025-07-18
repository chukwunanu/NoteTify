<?php

namespace App\Observers;

use App\Models\Note;
use App\Models\Activitylog;
use Illuminate\Support\Facades\Auth;

class NoteObserver
{
    /**
     * Handle the Note "created" event.
     */
    public function created(Note $note): void
    {
        Activitylog::create([
            'user_id' => Auth::id(),
            'action_type' => 'note_created',
            'note_id' => $note->id,
            'description' => "Created note: '{$note->content}'",
            'team_id' => $note->team_id ?? null,
        ]);
    }

    /**
     * Handle the Note "updated" event.
     */
    public function updated(Note $note): void
    {
        Activitylog::create([
            'user_id' => Auth::id(),
            'action_type' => 'note_edited',
            'note_id' => $note->id,
            'description' => "Updated note: '{$note->content}'",
            'team_id' => $note->team_id ?? null,
        ]);
    }

    /**
     * Handle the Note "deleted" event.
     */
    public function deleted(Note $note): void
    {
        Activitylog::create([
            'user_id' => Auth::id(),
            'action_type' => 'note_deleted',
            'note_id' => $note->id,
            'description' => "Deleted note: '{$note->content}'",
            'team_id' => $note->team_id ?? null,
        ]);
    }

    /**
     * Handle the Note "restored" event.
     */
    public function restored(Note $note): void
    {
        Activitylog::create([
            'user_id' => Auth::id(),
            'action_type' => 'note_restored',
            'note_id' => $note->id,
            'description' => "Restored note: '{$note->content}'",
            'team_id' => $note->team_id ?? null,
        ]);
    }

    /**
     * Handle the Note "force deleted" event.
     */
    public function forceDeleted(Note $note): void
    {
        Activitylog::create([
            'user_id' => Auth::id(),
            'action_type' => 'note_force_deleted',
            'note_id' => $note->id,
            'description' => "Permanently deleted note: '{$note->content}'",
            'team_id' => $note->team_id ?? null,
        ]);
    }
}
