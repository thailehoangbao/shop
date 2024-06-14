@extends('admin.post.layout')

@section('content')
<div class="card card-primary mt-3" style="width: fit-content;">
    <div class="card-header" style="width: 100%;">
        <h3 class="card-title"><small>{{$title}}</small></h3>
    </div>
    <!-- /.card-header -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Status</th>
                <th>Video</th>
                <th>Link</th>
                <th>Sub_title_1</th>
                <th>Content_1</th>
                <th>Thumb_1</th>
                <th>Sub_title_2</th>
                <th>Content_2</th>
                <th>Thumb_2</th>
                <th>Sub_title_3</th>
                <th>Content_3</th>
                <th>Thumb_3</th>
                <th>Updated_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lists as $key => $list)
            <tr>
                <td>{{ $list['id'] }}</td>
                <td>{{ \App\Helpers\Helpers::shorten($list['title']) }}</td>
                <td>{!! \App\Helpers\Helpers::active($list->status) !!}</td>
                <th>{{ \App\Helpers\Helpers::shorten($list['video']) }}</th>
                <th>{{ \App\Helpers\Helpers::shorten($list['link']) }}</th>
                <th>{{ \App\Helpers\Helpers::shorten($list['sub_title_1']) }}</th>
                <th>{{ \App\Helpers\Helpers::shorten($list['content_1']) }}</th>
                <th>
                    <img src="{{ asset('storage/uploads/'.$list['thumb_1']) }}" alt="{{ $list['thumb_1'] }}" width="50" height="50">
                </th>
                <th>{{ \App\Helpers\Helpers::shorten($list['sub_title_2']) }}</th>
                <th>{{ \App\Helpers\Helpers::shorten($list['content_2']) }}</th>
                <th>
                    <img src="{{ asset('storage/uploads/'.$list['thumb_2']) }}" alt="{{ $list['thumb_2'] }}" width="50" height="50">
                </th>
                <th>{{ \App\Helpers\Helpers::shorten($list['sub_title_3']) }}</th>
                <th>{{ \App\Helpers\Helpers::shorten($list['content_3']) }}</th>
                <th>
                    <img src="{{ asset('storage/uploads/'.$list['thumb_3']) }}" alt="{{ $list['thumb_3'] }}" width="50" height="50">
                </th>
                <td>{{ $list['updated_at'] }}</td>
                <td class="d-flex">
                    <a href="/admin/blog/post/edit/{{ $list->id }}" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                    <a href="/admin/blog/post/edit/{{ $list->id }}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{ url('/admin/blog/post/destroy') }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $list['id'] }}">
                        <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-circle-xmark"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>


@endsection
