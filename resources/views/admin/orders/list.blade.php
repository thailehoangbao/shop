@extends('admin.layout')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>User_Name</th>
            <th>Hình Ảnh</th>
            <th>Size</th>
            <th>Color</th>
            <th>Price</th>
            <th>Updated_at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $key => $order)
        <tr>
            <td>{{ $order['id'] }}</td>
            <td>{{ $order->user->email }}</td>
            <td>
                <img src="{{ asset('storage/uploads/'.$order->product->thumb) }}" alt="{{ $order->product->name }}" width="30" height="30">
            </td>
            <td>{{ $order['size'] }}</td>
            <td>{{ $order['color'] }}</td>
            <td>{{ $order->product->price }}</td>
            <td>{{ $order['updated_at'] }}</td>
            <td class="d-flex">
                <a href="/admin/orders/edit/{{ $order->id}}" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                <a href="/admin/orders/edit/{{ $order->id}}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i></a>
                <form action="{{ url('/admin/orders/destroy') }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $order['id'] }}">
                    <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-circle-xmark"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>


</table>
<div class="d-flex justify-content-center">
    {{ $orders->links('pagination::bootstrap-4') }}
</div>
@endsection
