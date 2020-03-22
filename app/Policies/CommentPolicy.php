<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Comment $comment)
    {
        return $user->isAuthorOf($comment) || $user->isAuthorOf($comment->topic);
    }
}
