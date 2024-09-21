<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(4);

        return view("users.show", compact("user", "ideas"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize("update", $user);

        $ideas = $user->ideas()->paginate(4);
        return view("users.edit", compact("user", "ideas"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        Gate::authorize("update", $user);

        $validated = $request->validated();

        if ($request->has('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);

        // return redirect()->route('profile')->with('success', 'Updated profile successfully!');
        return redirect()->route('users.show', $user)->with('success', 'Updated profile successfully!');
    }

    public function profile()
    {
        return $this->show(Auth::user());
    }
}
