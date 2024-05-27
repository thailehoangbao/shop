@extends('admin.layout')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Content</th>
            <th>Active</th>
            <th>Updated_at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($menus as $key => $menu)
        <tr>
            <td>{{ $menu['id'] }}</td>
            <td>{{ $menu['name'] }}</td>
            <td>{{ $menu['description'] }}</td>
            <td>{{ $menu['content'] }}</td>
            <td>{!! \App\Helpers\Helper::active($menu->active) !!}</td>
            <td>{{ $menu['updated_at'] }}</td>
            <td class="d-flex">
                <a href="/admin/menus/edit/{{ $menu->id}}" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                <a href="/admin/menus/edit/{{ $menu->id}}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i></a>
                <form action="{{ url('/admin/menus/destroy') }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $menu['id'] }}">
                    <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-circle-xmark"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

<div class="d-flex justify-content-center">
    {{ $menus->links('pagination::bootstrap-4') }}
</div>
@endsection
