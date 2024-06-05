<?php

namespace App\Http\Controllers\Client\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostAdmin\CreateFormRequest;
use App\Http\Services\Blog\BlogServices;
use App\Models\CategoryPost;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blogServices;
    public function __construct(BlogServices $blogServices)
    {
        $this->blogServices = $blogServices;
    }
    public function index()
    {
        return view('client.blog.index');
    }

    public function post()
    {
        $user = auth()->user();
        if(!$user) {
            return redirect()->route('login');
        }
        $categories = CategoryPost::all();
        return view('client.blog.userpost',[
            'categories' => $categories
        ]);
    }

    public function userCreatePost(CreateFormRequest $request)
    {
        $user = auth()->user();
        if(!$user) {
            return redirect()->route('login');
        }
        $result = $this->blogServices->createPost($request,$user);
        if(!$result) {
            return redirect()->back()->with('error', 'You send post fail!');
        }
        return redirect()->back()->with('success', 'You send post success!');
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
        if(!$user) {
            return redirect()->route('login');
        }
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->save();
        return redirect()->back()->with('success', 'You send comment success!');
    }
}
