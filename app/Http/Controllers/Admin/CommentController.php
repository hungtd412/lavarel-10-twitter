<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Exception;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(5);

        return view("admin.comments.index", compact("comments"));
    }

    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
        } catch (Exception $e) {
            return redirect()->route('admin.comments.index')->with('error', $e->getMessage());
        }
        return redirect()->route("admin.comments.index")->with("success", "Comment deleted successfully!");
    }
}
