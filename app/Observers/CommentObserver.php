<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\TopicComment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        $comment->topic->updateCommentCount();
        // 通知话题作者有新的评论
        $comment->topic->user->notify(new TopicComment($comment));
    }
}
