<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $idea = new Idea([
        //     "content" => "hello youtube",
        //     "likes" => 172,
        // ]);
        // $idea->save();

        $ideas = Idea::orderBy('created_at', 'desc');


        /*
        *Return all customers from a city that contains the letter 'L':
        *
        *SELECT * FROM Customers
        *WHERE city LIKE '%L%';
        */
        if (request()->has('search')) {
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search', '') . '%');
            //request()->get('search', '') means that, if not having 'search', using '' as default
        }

        return view('dashboard', [
            'ideas' => $ideas->paginate(4)->withQueryString()
        ]);
    }
}
