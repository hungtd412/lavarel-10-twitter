<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {

        // if (Gate::denies("admin")) {
        //     abort(403);
        // }
        // Gate::authorize("admin");

        $totalUsers = User::count();
        $totalIdeas = Idea::count();
        $totalComments = Comment::count();

        return view('admin.dashboard', compact('totalUsers', 'totalIdeas', 'totalComments'));
    }
}
