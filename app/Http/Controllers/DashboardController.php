<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function addCanEditField($ideas)
    // {
    //     foreach ($ideas as $idea) {
    //         if (Auth::user() == null) {
    //             $idea->canEdit = false;
    //         } else {
    //             $idea->canEdit = Auth::user()->id == $idea->user_id;
    //         }
    //     }

    //     return $ideas;
    // }
    public function index()
    {
        $ideas = Idea::orderBy('created_at', 'desc');


        if (request()->has('search')) {
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search', '') . '%');
            //request()->get('search', '') means that, if not having 'search', using '' as default
        }

        //must put this line above "$ideas = $this->addCanEditField($ideas);", because $ideas was converted into collection after addCanEditField()
        $ideas = $ideas->paginate(4);

        // $ideas = $this->addCanEditField($ideas);

        return view('dashboard', [
            'ideas' => $ideas,
        ]);
    }
}
