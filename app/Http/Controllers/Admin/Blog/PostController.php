<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostAdmin\CreateFormRequest;
use App\Http\Services\Post_Admin\PostServices;
use App\Models\Post;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;

class PostController extends Controller
{
    protected $postServices;

    public function __construct(PostServices $postServices)
    {
        $this->postServices = $postServices;
    }

    public function index()
    {
        $categories = $this->postServices->getCategories();
        return view('admin.post.add', [
            'title' => 'Thêm bài viết mới',
            'categories' => $categories
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $this->postServices->store($request);
        return redirect()->back()->with('success', 'Thêm bài viết thành công');
    }

    public function list()
    {
        $lists = Post::all();
        return view('admin.post.list', [
            'title' => 'Danh sách bài viết',
            'lists' => $lists
        ]);
    }

    public function destroy(HttpRequest $request)
    {
        Helpers::deleteFile($request->thumb_1);
        Helpers::deleteFile($request->thumb_2);
        Helpers::deleteFile($request->thumb_3);
        $this->postServices->destroy($request->id);
        return redirect()->back()->with('success', 'Xóa bài viết thành công');
    }

    public function edit($id)
    {
        $categories = $this->postServices->getCategories();
        $post = Post::find($id)->with('category_post')->first();
        return view('admin.post.edit', [
            'title' => 'Chỉnh sửa bài viết',
            'categories' => $categories,
            'post' => $post
        ]);
    }

    public function update(CreateFormRequest $request)
    {
        $this->postServices->update($request);
        return redirect()->back()->with('success', 'Cập nhật bài viết thành công');
    }
}
