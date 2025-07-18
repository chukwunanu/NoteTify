<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Activitylog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($teamId)
    {
        $team = Team::findOrFail($teamId);
    
        if (! $team->users->contains(Auth::id())) {
            return redirect()->back()->with('fail', 'You are not an authorized member of this team');
        }
    
        $activityLogs = Activitylog::where('team_id', $team->id)
            ->with(['user', 'note']) // eager load related models
            ->latest()
            ->get();
    
        return view('teams.activity-logs', compact('team', 'activityLogs'));
    }

    /**
     * Show the form for creating a new resource.
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
        //
    }
}
