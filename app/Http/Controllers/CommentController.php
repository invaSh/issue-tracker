<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Issue;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request, Issue $issue)
    {
        $request->validate([
            'body' => 'required|string',
            'author_name' => 'required|string',
        ],[
            'body.required' => 'The comment content cannot be empty.',
            'author_name.required' => 'The  author name cannot be empty.',
        ]);

        $comment = $issue->comments()->create([
            'body' => $request->body,
            'author_name' => $request->author_name,
        ]);

        return response()->json([
            'success' => true,
            'comment' => $comment,
        ]);
    }

}
