<?php

namespace App\Http\View\Composers;

use App\Models\Comment;
use Illuminate\View\View;

class CommentsComposer
{
    public function compose(View $view)
    {
        $comments = Comment::with('user')->orderBy('created_at', 'asc')->get();
        $view->with('comments', $comments);
    }
}
