<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Issue;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(StoreCommentRequest $request, Issue $issue)
    {

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
