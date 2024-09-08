<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Support\Facades\Auth;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea)
    {
        $idea->likes()->attach(Auth::user());

        return redirect()->route("dashboard")->with("success", "Like successfully!");
    }
    public function unlike(Idea $idea)
    {
        $idea->likes()->detach(Auth::user());

        return redirect()->route("dashboard")->with("success", "Unlike successfully!");
    }
}
