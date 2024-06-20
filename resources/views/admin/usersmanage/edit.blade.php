@extends('admin.layout')
@section('content')
<div class="card card-primary">
    @include('admin.session')

    <!-- form start -->
    <form action="" method="POST" >
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên Người Dùng(*)</label>
                <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{$user->name}}"></input>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email(*)</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{$user->email}}"></input>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password(*)</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" >
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number">Số Điện Thoại</label>
                <input type="text" name="phone_number" class="form-control"  placeholder="Enter phone"  value="{{$user->phone_number}}"></input>
                @error('phone_number')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="location">Địa chỉ nhà</label>
                <input type="text" name="location" class="form-control" placeholder="Enter vị trí" value="{{$user->location}}"></input>
                @error('location')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select class="form-control" name="status">
                    <option value="{{$user->status}}">
                        @if($user->status == 0)
                        Chưa kích hoạt
                        @elseif($user->status == 1)
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

            <div class="form-group">
                <label for="status">Quyền Quản Trị</label>
                <select class="form-control" name="role_id">
                    <option value="{{$user->role_id}}">
                        @if($user->role_id == 10)
                        ADMIN
                        @elseif($user->role_id == 1)
                        USER
                        @else
                        Ẩn
                        @endif
                    </option>
                    <option value="1">USER</option>
                    <option value="10">ADMIN</option>
                    <option value="1">USER</option>
                </select>
                @error('role_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <input type="text" hidden value="{{$user->id}}" name="id">

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Cập Nhật Tài Khoản</button>
        </div>
        @csrf
    </form>

</div>
@endsection

@section('ckeditorfooter')


@endsection
