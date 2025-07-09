<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::all();
        return view('notes.projects', compact('notes'));
    }

    /**
     * Show all notes with same team_id as the authenticated user.
     * This method assumes that each user belongs to one team.
     * If a user can belong to multiple teams, this logic would need to be adjusted.
     */
   /**
    * Show all notes where the team_id matches the currently active team
    * of the authenticated user. Assumes "active" team is the first one.
    */

    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:5',
            'team_id' => 'required|exists:teams,id',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->withErrors(['message' => 'User not authenticated.']);
        }

        // Check that user belongs to the team
        if (!$user->teams->contains('id', $validated['team_id'])) {
            return redirect()->back()->withErrors(['message' => 'You are not a member of the selected team.']);
        }

        // Create the note
        $note = Note::create([
            'content' => $validated['content'],
            'user_id' => $user->id,
            'team_id' => $validated['team_id'],
            'created_by' => $user->name,
        ]);

        return redirect()->route('teams.show')->with('success', 'Note created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $note = Note::findOrFail($id);

            if (!$note->team->users->contains(Auth::id())) {
                return redirect()->route('user.index')->with('error', 'Unauthorized access to this note.');
            }

            return view('notes.show-note', compact('note'));
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Note not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $note = Note::findOrFail($id);
            return view('notes.note-edit', compact('note'));
        } catch (\Exception $e) {
            return redirect()->route('notes.edit')->with('error', 'Note not found.');
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'content' => 'required|string|min:5',
        ]);

        try {
            $note = Note::findOrFail($id);
            $note->update([
                'content' => $request->input('content'),
            ]);
            return redirect()->route('teams.show')->with('success', 'Note updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('notes.edit')->with('error', 'Note not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $note = Note::findOrFail($id);
            $note->delete();
            return redirect()->route('user.index')->with('success', 'Note deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Note not found.');
        }
    }
}
