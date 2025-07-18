<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Activitylog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $teamId = $request->input('team_id');
        $noteId = $request->input('note_id');

        $query = Activitylog::where('user_id', $user->id);

        if ($teamId) {
            $query->where('team_id', $teamId);
        }

        if ($noteId) {
            $query->where('note_id', $noteId);
        }

        $activityLogs = $query->latest()->get();

        return view('logs.activity-logs', compact('activityLogs'));
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
