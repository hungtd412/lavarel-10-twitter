<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Idea $idea)
    {
        return view("ideas.show", compact("idea"));
    }

    public function store()
    {

        $validated = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

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
        try {
            $idea->delete();
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dashboard')->with('error', 'This idea was already deleted!');
        }
        return redirect()->route('dashboard')->with('success', 'Idea was deleted successfully!');
    }

    public function edit(Idea $idea)
    {
        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea)
    {
        $validated = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        $idea->update($validated);

        // return view('ideas.show', compact('idea'));
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated successfully!');
    }
}
