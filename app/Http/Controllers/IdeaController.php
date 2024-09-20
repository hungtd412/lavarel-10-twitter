<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    public function show(Idea $idea)
    {
        return view("ideas.show", compact("idea"));
        //compact('idea'): lavarel will find variable named idea and return an copy object os that for us
        //instead of return view("ideas.show", 'idea' => $idea);
    }

    public function store(CreateIdeaRequest $request)
    {

        $validated = $request->validated();

        $validated['user_id'] = Auth::id();

        Idea::create($validated);

        return redirect()->route('dashboard')->with('success', 'Idea was created successfully!');
        // return redirect()->back()->with('success', 'Idea was created successfully!');
    }

    /*
    *   Lavarel will do some background works to get the Idea instance whose id matchs with
    *   $idea(this is the id we passed throuhout the route in web.php)
    */
    public function destroy(Idea $idea)
    {
        Gate::authorize('delete', $idea);
        try {
            $idea->delete();
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dashboard')->with('error', 'This idea was already deleted!');
        }
        return redirect()->route('dashboard')->with('success', 'Idea was deleted successfully!');
    }

    public function edit(Idea $idea)
    {
        Gate::authorize('update', $idea);

        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        Gate::authorize('update', $idea);

        $validated = $request->validated();

        $idea->update($validated);

        // return view('ideas.show', compact('idea'));
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated successfully!');
    }
}
