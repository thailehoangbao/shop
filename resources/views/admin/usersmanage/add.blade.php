@extends('admin.layout')
@section('content')
<div class="card card-primary">
    @include('admin.session')

    <!-- form start -->
    <form action="" method="POST" >
        <div class="card-body">

            <div class="form-group">
                <label for="name">Tên Người Dùng(*)</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email(*)</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password(*)</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password">
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number">Số Điện Thoại</label>
                <input type="text" name="phone_number" class="form-control"  placeholder="Enter phone"></input>
                @error('phone_number')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="location">Địa chỉ nhà</label>
                <input type="text" name="location" class="form-control" placeholder="Enter vị trí"></input>
                @error('location')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select class="form-control" name="status">
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
                    <option value="1">USER</option>
                    <option value="10">ADMIN</option>
                    <option value="1">USER</option>
                </select>
                @error('role_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Tạo Tài Khoản</button>
        </div>
        @csrf
    </form>

</div>
@endsection

@section('ckeditorfooter')


@endsection
