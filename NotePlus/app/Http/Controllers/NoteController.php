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
    $team = Auth::user()->teams->first();

    // Check if the user is in a team
    if (!$team) {
        return redirect()->route('teams.create')->with('fail', 'Please join or create a team first.');
    }

    $notes = Note::where('team_id', $team->id)
                 ->where('user_id', Auth::id()) // Optional: limit to current user’s notes
                 ->get();

    return view('notes.projects', compact('notes', 'team'));
}

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
            'title' => 'required|string|min:3',
            'content' => 'required|string|min:5',
            'team_id' => 'required|exists:teams,id',
        ]);
    
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->back()->with(['fail' => 'User not authenticated.']);
        }
    
        if (!$user->teams->contains('id', $validated['team_id'])) {
            return redirect()->back()->with(['fail' => 'You are not a member of this team.']);
        }

        if (trim($validated['content']) === '') {
            return redirect()->back()->with('fail', 'This note cannot be empty. Minimum of five characters required');
        }

    
        $note = Note::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => $user->id,
            'team_id' => $validated['team_id'],
            'created_by' => $user->name,
        ]);
    
        return redirect()->route('teams.show', $validated['team_id'])->with('success', 'Note created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $note = Note::findOrFail($id);

            if (!$note->team->users->contains(Auth::id())) {
                return redirect()->route('user.index')->with('fail', 'Unauthorized access to this note.');
            }

            return view('notes.show-note', compact('note'));
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('fail', 'Note not found.');
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
            return redirect()->route('notes.edit', $id)->with('fail', 'Note not found.');
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

            if ($note->user_id !== Auth::id()) {
                return redirect()->back()->withErrors(['fail' => 'You do not have permission to edit this note.']);
            }

            $note->update([
                'content' => $request->input('content'),
            ]);
            return redirect()->route('teams.show', $note->team_id)->with('success', 'Note updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('notes.edit', $id)->with('fail', 'Note not found.');
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
            return redirect()->route('user.index')->with('fail', 'Note not found.');
        }
    }
}
