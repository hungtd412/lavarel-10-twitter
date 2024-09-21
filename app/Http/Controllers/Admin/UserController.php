<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {

        // if (Gate::denies("admin")) {
        //     abort(403);
        // }
        // Gate::authorize("admin");

        $users = User::latest()->where('is_admin', '=', 0)->paginate(3);

        return view('admin.users.index', compact('users'));
    }
}
