@extends('admin.layout')
@section('ckeditorhead')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endsection
@section('content')
<div class="card card-primary">
    @include('admin.session')

    <!-- form start -->
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="card-body">

            <div class="form-group">
                <label for="name">Tên Danh Mục</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="danhmuc">Danh Mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Danh mục cha</option>
                    @foreach($menus as $menu)
                    <option value="{{$menu->id}}">{{$menu->name}}</option>
                    @endforeach
                </select>
                @error('parent_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="desciption">Mô tả</label>
                <textarea type="text" name="description" class="form-control" id="mota" placeholder="Enter mô tả"></textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Mô tả Chi tiết</label>
                <textarea type="text" name="content" class="form-control" id="editor" placeholder="Enter mô tả content"></textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" value="1" name="active" id="active" type="radio" checked="">
                    <label for="active" class="form-check-label">Có</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="0" name="active" id="non-active" type="radio">
                    <label for="nonactive" class="form-check-label">Không</label>
                </div>
            </div>

            <div class="form-control">
                <label for="file">Upload Hình Ảnh</label>
                <input type="file" name="thumb" id="file" placeholder="Input File Image">
                @error('thumb')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Tạo danh mục</button>
        </div>
        @csrf
    </form>
</div>
@endsection

@section('ckeditorfooter')

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>

@endsection
