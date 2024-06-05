<?php

namespace App\Http\Controllers\Client\Blog;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('client.blog.index');
    }

    public function post()
    {
        return view('client.blog.post');
    }

    public function about()
    {
        return view('client.blog.about');
    }

    public function contact()
    {
        return view('client.blog.contact');
    }

    public function postDetail(Post $post)
    {
        return view('client.blog.post', compact('post'));
    }

    public function comment(Request $request)
    {
        $user = auth()->user();
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->save();
        return redirect()->back()->with('success', 'You send comment success!');
    }
}
