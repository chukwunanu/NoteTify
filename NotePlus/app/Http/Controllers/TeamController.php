<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Team;
use App\Models\Invite;
use App\Models\TeamUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $team = Auth::user()->teams;

        if ($team->isEmpty()) {
            return redirect()->back()->with('fail', 'No teams found.');
        }

        return view('teams.index-team', compact('team'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teams.create-team');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_name' => 'required|string'
        ]);

        try 
        {
             $user = Auth::user();

            $userId = $user->id;

            if (!$user) {
                return redirect()->back()->withErrors('message', 'User not authenticated.');
            }

            $teams = new Team();

            $team = Team::create([
                'team_name' => $validated['team_name'],
                'user_id' => $userId
            ]);

            $team_users = TeamUser::create([
                'team_id' => $team->id,
                'user_id' => $user->id,
                'role' => 'owner',
            ]);

            Log::info(' team created', ['id' => $team->id]);
            return redirect()->route('teams.index')->with('success', 'Team Created successfully!');

        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect('/teams')->with('fail', 'Sorry!! Team was not created successfully: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $team = Team::findOrFail($id);
           
            $user = Auth::user();

            new Note();

            // Check if user belongs to this team before setting as active
            if (!$user->teams->contains($team)) {
                return redirect()->route('teams.index')->with('fail', 'You do not belong to this team.');
            }

            session(['active_team_id' => $team->id]);
            
           $notes = $team->notes;
            
            if (!$notes) {
                return view('teams.show-team', compact('team'))->with('fail', 'No notes found for this team.');
            }
        
            $notes = Note::where('team_id', $team->id)->get();
        
                return view('teams.show-team', compact('team', 'notes'));
            } catch (\Exception $e) {
            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('teams.index')->with('fail', 'Failed to retrieve team: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $team = Team::findOrFail($id);
            return view('teams.edit-team', compact('team'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('teams.index')->with('fail', 'Failed to retrieve team for editing: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'team_name' => 'required|string'
        ]);

        try {
            if (!Auth::user()->teams->contains('id', $id)) {
                return redirect()->route('teams.index')->with('fail', 'You do not have permission to update this team.');
            }

            $team = Team::findOrFail($id);
            $team->update($validated);

            Log::info('Team updated successfully', ['id' => $id]);
            return redirect()->route('teams.index')->with('success', 'Team updated successfully!');
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('teams.index')->with('fail', 'Failed to update team: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if (!Auth::user()->teams->contains('id', $id)) {
                return redirect()->route('teams.index')->with('fail', 'You do not have permission to delete this team.');
            }
            $team = Team::findOrFail($id);
            $team->delete();

            Log::info('Team deleted successfully', ['id' => $id]);
            return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('teams.index')->with('fail', 'Failed to delete team: ' . $e->getMessage());
        }
    }
}
