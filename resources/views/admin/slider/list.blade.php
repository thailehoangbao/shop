@extends('admin.layout')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Hình Ảnh</th>
            <th>Updated_at</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sliders as $key => $slider)
        <tr>
            <td>{{ $slider['id'] }}</td>
            <td>{{ $slider['name'] }}</td>
            <td>{{ $slider['thumb']  }}</td>
            <td>{{ $slider['updated_at'] }}</td>
            <td>{!! \App\Helpers\Helper::active($slider->active) !!}</td>
            <td class="d-flex">
                <a href="/admin/sliders/edit/{{ $slider->id}}" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                <a href="/admin/sliders/edit/{{ $slider->id}}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i></a>
                <form action="{{ url('/admin/sliders/destroy') }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $slider['id'] }}">
                    <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-circle-xmark"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>


</table>
<div class="d-flex justify-content-center">
    {{ $sliders->links('pagination::bootstrap-4') }}
</div>
@endsection
