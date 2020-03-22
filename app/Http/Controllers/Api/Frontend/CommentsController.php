<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Frontend\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(CommentRequest $request, Topic $topic, Comment $comment)
    {
        $comment->text = $request->text;
        $comment->topic()->associate($topic);
        $comment->user()->associate($request->user());
        $comment->save();

        return new CommentResource($comment);
    }

    public function destroy(Topic $topic, Comment $comment)
    {
        if ($comment->topic_id != $topic->id) {
            abort(404);
        }

        $this->authorize('destroy', $comment);
        $comment->delete();

        return response(null, 204);
    }
}
