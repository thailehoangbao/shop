<?php

namespace App\Http\View\Composers;

use App\Models\Post;
use Illuminate\View\View;

class PostsComposer
{
    public function __construct(public Post $post) {

    }

    public function compose(View $view)
    {
        $posts = Post::where('status',1)->with('category_post')->orderByDesc('id')->get();
        $view->with('posts', $posts);
    }
}
