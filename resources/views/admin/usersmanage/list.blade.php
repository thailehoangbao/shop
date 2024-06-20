@extends('admin.layout')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Avatar</th>
            <th>Email</th>
            <th>Location</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Role</th>
            <th>Updated_at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $key => $user)
        <tr>
            <td>{{ $user['id'] }}</td>
            <td>{{ $user['name'] }}</td>
            <td>
                @if($user->avatar == null)
                null
                @else
                <img src="{{ asset('storage/uploads/'.$user->avatar) }}" alt="{{ $user->name }}" width="30" height="30">
                @endif
            </td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $user['location'] }}</td>
            <td>{{ $user['phone_number'] }}</td>
            <td>{{ $user['status'] }}</td>
            <td>
                @if($user['role_id'] == 10)
                Admin
                @elseif($user['role_id'] == 1)
                User
                @else
                Ẩn
                @endif
            </td>
            <td>{{ $user['updated_at'] }}</td>
            <td class="d-flex">
                <a href="/admin/users/edit/{{ $user->id}}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i></a>
                <form action="{{ url('/admin/users/destroy') }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $user['id'] }}">
                    <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-circle-xmark"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>


</table>
<div class="d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-4') }}
</div>
@endsection
