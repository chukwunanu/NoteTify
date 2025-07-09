<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\TeamUser;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.sign-up');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreRegisterRequest $request)
{
    $validatedData = $request->validated();

    try {
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['password_confirmation'] = Hash::make($validatedData['password_confirmation']);

        $users = User::create($validatedData);
    
        $team = Team::create([
            'team_name' => $users->name,
            'user_id' => $users->id,
        ]);

        $team_users = TeamUser::create([
            'team_id' => $team->id,
            'user_id' => $users->id,
            'role' => 'owner',
        ]);

        // $users->teams()->attach($team->id, $users->id, ['role' => 'owner']);

        Log::info('User registered and team created', ['user_id' => $users->id]);
        Auth::login($users);
        return redirect()->route('user.index')->with('success', 'Registration Successful');
    } catch (\Exception $e) {
        Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
        return redirect('/signup')->with('fail', 'Sorry!! Registration Failed: ' . $e->getMessage());
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $teams = $user->teams;
            return view('app.welcome', compact('user', 'teams'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect('/home')->with('fail', 'User not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $user = User::findOrFail($id);
            return view('auth.edit-profile', compact('user'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect('/home')->with('fail', 'User not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRegisterRequest $request, string $id)
    {
        $validatedData = $request->validated();

        try {
            $user = User::findOrFail($id);
            $user->update($validatedData);

            Log::info('User profile updated', ['user_id' => $user->id]);

            return redirect()->route('user.index')->with('success', 'Profile Updated Successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect('/home')->with('fail', 'Profile Update Failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            Log::info('User deleted', ['user_id' => $user->id]);

            return redirect('/')->with('success', 'User Deleted Successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect('/home')->with('fail', 'User Deletion Failed: ' . $e->getMessage());
        }
    }
}
