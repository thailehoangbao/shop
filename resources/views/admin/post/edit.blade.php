@extends('admin.layout')

@section('content')
<div class="card card-primary">
    @include('admin.session')
    <!-- form start -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <input type="text" value="{{$post->id}}" hidden name="id">
            <div class="form-group">
                <label for="title">Tiêu đề bài post</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter post title" value="{{$post->title}}">
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="link">Link liên quan (nếu có)</label>
                <input type="text" name="link" class="form-control" id="link" placeholder="Enter post link" value="{{$post->link}}">
                @error('link')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="video">Link iframe video bài viết (nếu có)</label>
                <input type="text" name="video" class="form-control" id="video" placeholder="Enter post video" value="{{$post->video}}">
                @error('video')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_post_id">Chọn chủ đề</label>
                <select name="category_post_id" class="form-control">
                    <option value="{{$post->category_post_id}}">
                        @foreach($categories as $category)
                            @if($category->id == $post->category_post_id)
                                {{ $category->name }}
                            @endif
                        @endforeach
                    </option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_post_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select class="form-control" name="status">
                    <option value="{{$post->status}}">
                    @if($post->status == 0)
                        Chưa kích hoạt
                    @elseif($post->status == 1)
                        Kích hoạt
                    @else
                        Ẩn
                    @endif
                    </option>
                    <option value="0">Chưa kích hoạt</option>
                    <option value="1">Kích hoạt</option>
                    <option value="2">Ẩn</option>
                </select>
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div style="border: 0.5px solid #999999; width: 100%; margin-top: 20px;"></div>



            <div class="form-group">
                <h5>Nội dung 1</h5>
                <div class="form-group">
                    <label for="sub_title_1">Tiêu đề</label>
                    <input type="text" name="sub_title_1" class="form-control" id="sub_title_1" placeholder="Enter post sub title" value="{{$post->sub_title_1}}">
                    @error('sub_title_1')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content_1">Nội dung</label>
                    <textarea name="content_1" class="form-control" id="content_1" placeholder="Enter post content">{{$post->content_1}}</textarea>
                    @error('content_1')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-control">
                    <label for="file">Upload hình ảnh</label>
                    <input type="file" name="thumb_1" id="thumb_1" placeholder="Input File Image" value="{{$post->thumb_1}}">
                    @error('thumb_1')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div style="border: 0.5px solid #999999; width: 100%; margin-top: 20px;"></div>

            <div class="form-group">
                <h5>Nội dung 2</h5>
                <div class="form-group">
                    <label for="sub_title_2">Tiêu đề</label>
                    <input type="text" name="sub_title_2" class="form-control" id="sub_title_2" placeholder="Enter post sub title" value="{{$post->sub_title_2}}">
                    @error('sub_title_2')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content_2">Nội dung</label>
                    <textarea name="content_2" class="form-control" id="content_2" placeholder="Enter post content">{{$post->content_2}}</textarea>
                    @error('content_2')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-control">
                    <label for="file">Upload hình ảnh</label>
                    <input type="file" name="thumb_2" id="thumb_2" placeholder="Input File Image" value="{{$post->thumb_2}}">
                    @error('thumb_2')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div style="border: 0.5px solid #999999; width: 100%; margin-top: 20px;"></div>

            <div class="form-group">
                <h5>Nội dung 3</h5>
                <div class="form-group">
                    <label for="sub_title_3">Tiêu đề</label>
                    <input type="text" name="sub_title_3" class="form-control" id="sub_title_3" placeholder="Enter post sub title" value="{{$post->sub_title_3}}">
                    @error('sub_title_3')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content_3">Nội dung</label>
                    <textarea name="content_3" class="form-control" id="content_3" placeholder="Enter post content">{{$post->content_3}}</textarea>
                    @error('content_3')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-control">
                    <label for="file">Upload hình ảnh</label>
                    <input type="file" name="thumb_3" id="thumb_3" placeholder="Input File Image"  value="{{$post->thumb_3}}">
                    @error('thumb_3')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Cập nhật bài viết</button>
        </div>
        @csrf
    </form>
</div>
@endsection
