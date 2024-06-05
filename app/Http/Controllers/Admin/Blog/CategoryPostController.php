<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    public function index()
    {
        return view('admin.category_post.add',[
            'title' => 'Thêm danh mục bài viết'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ],[
            'name.required' => 'Tên danh mục không được để trống',
            'status.required' => 'Trạng thái không được để trống',
        ]);

        $category = new CategoryPost();

        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();
        return redirect()->back()->with('success','Thêm danh mục bài viết thành công');
    }

    public function list()
    {
        $categories = CategoryPost::all();
        return view('admin.category_post.list',[
            'title' => 'Danh sách danh mục bài viết',
            'categories' => $categories
        ]);
    }

    public function destroy(Request $request)
    {
        $category = CategoryPost::find($request->id);
        $category->delete();
        return redirect()->back()->with('success','Xóa danh mục bài viết thành công');
    }

    public function edit($id)
    {
        $category = CategoryPost::find($id);
        return view('admin.category_post.edit',[
            'title' => 'Sửa danh mục bài viết',
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ],[
            'name.required' => 'Tên danh mục không được để trống',
            'status.required' => 'Trạng thái không được để trống',
        ]);

        $category = CategoryPost::find($id);

        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();
        return redirect()->back()->with('success','Sửa danh mục bài viết thành công');
    }
}
