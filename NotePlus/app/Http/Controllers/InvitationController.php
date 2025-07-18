<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Invite;
use App\Mail\InviteMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Database\QueryException;

class InvitationController extends Controller
{
    public function sendInvite(Request $request, Team $team)
    {
        $request->validate([
            'email' => 'required|email',
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $token = Str::random(40);

        Invite::create([
            'team_id' => $request->team_id,
            'email' => $request->email,
            'token' => $token,
            'accepted' => false,
            'expires_at' => now()->addDays(2),
            'user_id' => $request->user_id,
        ]);

        $APP_URL =  " http://127.0.0.1:8000";

        $inviteLink = url("{$APP_URL}/invite/accept/{$token}/{$team->id}");

        // $inviteLink = route('invites.accept', ['token' => $token, 'team' => $team->id]);


        Mail::to($request->email)->send(new InviteMail($inviteLink, $team));

        return redirect()->route('teams.show', $team->id)->with('success', 'Invitation sent successfully!');
    }

    public function acceptInvite($token)
    {
        $invitation = Invite::where('token', $token)->where('accepted', false)->firstOrFail();

        if ($invitation->expires_at < now()) {
            return redirect()->route('welcome')->with('fail', 'This invitation has expired.');
        }
        // Logic to add the user to the team
        $user = new User();

        Auth::user();

        try {
            $user->teams()->attach($invitation->team_id);
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('user.index')->with('fail', 'Looks like you have already joined this team!');
            }       
        }

        $invitation->update(['accepted' => true]);

        return redirect()->route('welcome', ['id' => $invitation->team_id])
                         ->with('success', 'Invitation accepted successfully!');
    }

    public function showMembers($teamId)
    {
        $team = Team::with(['users' => function ($query) {
            $query->withPivot('role');
        }])->findorFail($teamId);

        return view('teams.show-team', compact('team'));
    }

    public function removeMember($teamId, $userId)
    {
        $team = Team::findOrFail($teamId);

        if (! $team->users()->where('user_id', $userId)->exists()) {
            return redirect()->back()->with('fail', 'You are not a member of this team.');
        }

        if ($team->users()->where('user_id', $userId)->first()->pivot->role === 'owner') {
            return redirect()->back()->with('fail', 'Owner cannot be removed.');
        }

        $team->users()->detach($userId);

        return redirect()->back()->with('success', 'This Member has beensuccessfully removed from this team.');
    }

}
