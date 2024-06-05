<?php

namespace App\Http\Services\Post_Admin;

use App\Helpers\Helpers;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostServices
{
    public function getCategories()
    {
        return CategoryPost::all();
    }

    public function store($request)
    {
        $thumb_1 = Helpers::handleFile($request, 'thumb_1');
        $thumb_2 = Helpers::handleFile($request, 'thumb_2');
        $thumb_3 = Helpers::handleFile($request, 'thumb_3');
        try {
            $post = new Post();
            $post->title = $request->title;
            $post->status = $request->status;
            $post->sub_title_1 = $request->sub_title_1;
            $post->sub_title_2 = $request->sub_title_2;
            $post->sub_title_3 = $request->sub_title_3;
            $post->content_1 = $request->content_1;
            $post->content_2 = $request->content_2;
            $post->content_3 = $request->content_3;
            $post->video = $request->video;
            $post->category_post_id = $request->category_post_id;
            $post->link = $request->link;
            $post->thumb_1 = $thumb_1;
            $post->thumb_2 = $thumb_2;
            $post->thumb_3 = $thumb_3;
            $post->save();

            Session::flash('success', 'Product updated successfully');
            return true;
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($id)
    {
        try {
            $post = Post::find($id);
            Helpers::deleteFile($post->thumb_1);
            Helpers::deleteFile($post->thumb_2);
            Helpers::deleteFile($post->thumb_3);
            $post->delete();
            Session::flash('success', 'Product deleted successfully');
            return true;
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return false;
        }
    }

    public function update($request)
    {
        $post = Post::find($request->id);
        $thumb_1 = Helpers::handleUpdateFile($request, $post->thumb_1, 'thumb_1');
        $thumb_2 = Helpers::handleUpdateFile($request, $post->thumb_2, 'thumb_2');
        $thumb_3 = Helpers::handleUpdateFile($request, $post->thumb_3, 'thumb_3');
        try {
            $post->title = $request->title;
            $post->status = $request->status;
            $post->sub_title_1 = $request->sub_title_1;
            $post->sub_title_2 = $request->sub_title_2;
            $post->sub_title_3 = $request->sub_title_3;
            $post->content_1 = $request->content_1;
            $post->content_2 = $request->content_2;
            $post->content_3 = $request->content_3;
            $post->video = $request->video;
            $post->category_post_id = $request->category_post_id;
            $post->link = $request->link;
            $post->thumb_1 = $thumb_1;
            $post->thumb_2 = $thumb_2;
            $post->thumb_3 = $thumb_3;
            $post->save();

            Session::flash('success', 'Product updated successfully');
            return true;
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return false;
        }
        return true;
    }
}
