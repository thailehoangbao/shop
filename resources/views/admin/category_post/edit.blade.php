@extends('admin.layout')

@section('content')
<div class="card card-primary">
    @include('admin.session')

    <!-- form start -->
    <form action="" method="post">

        <div class="card-body">

            <div class="form-group">
                <label for="name">Chỉnh sửa Post</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{$category->name}}">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select class="form-control" name="status">
                    <option value="{{$category->status}}">{{$category->status == 0 ? 'Chưa kích hoạt' : ($category->status == 1 ? 'Kích hoạt' : 'Ẩn')}}</option>
                    <option value="0">Chưa kích hoạt</option>
                    <option value="1">Kích hoạt</option>
                    <option value="2">Ẩn</option>
                </select>
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Cập nhật chủ đề</button>
        </div>
        @csrf
    </form>
</div>
@endsection
