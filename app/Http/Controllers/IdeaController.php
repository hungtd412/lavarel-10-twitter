<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    public function canEdit(Idea $idea)
    {
        return Auth::user()->id == $idea->user_id;
    }

    public function show(Idea $idea)
    {
        $editable = $this->canEdit($idea);
        return view("ideas.show", compact("idea", 'editable'));
        //compact('idea'): lavarel will find variable named idea and return an copy object os that for us
        //instead of return view("ideas.show", 'idea' => $idea);
    }

    public function store()
    {

        $validated = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

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
        if (Auth::user()->id !== $idea->user_id) {
            abort(404);
        }

        try {
            $idea->delete();
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dashboard')->with('error', 'This idea was already deleted!');
        }
        return redirect()->route('dashboard')->with('success', 'Idea was deleted successfully!');
    }

    public function edit(Idea $idea)
    {
        if (Auth::user()->id !== $idea->user_id) {
            abort(404);
        }

        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea)
    {
        if (Auth::user()->id !== $idea->user_id) {
            abort(404);
        }

        $validated = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        $idea->update($validated);

        // return view('ideas.show', compact('idea'));
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated successfully!');
    }
}
