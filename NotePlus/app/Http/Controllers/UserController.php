<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $team = Auth::user()->teams->first();
        $teams = $team ? $team->team_name : null;

        // if (!$team) {
        //     return redirect()->route('teams.create')->with('error', 'Please join or create a team first.');
        // }

        // $users = $team ? $team->users : collect();

        $notes = Note::where('user_id', Auth::id())
            ->where('team_id', Auth::user()->teams->first()->id)
            ->get();
        return view('app.index', compact('notes', 'team'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('welcome')->with('success', 'Note deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Note not found.');
        }
    }
}
