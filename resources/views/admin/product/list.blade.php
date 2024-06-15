@extends('admin.layout')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Hình Ảnh</th>
            <th>Tên Danh Mục</th>
            <th>Price</th>
            <th>Price_sale</th>
            <th>Active</th>
            <th>Updated_at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key => $product)
        <tr>
            <td>{{ $product['id'] }}</td>
            <td>{{ $product['name'] }}</td>
            <td>
                {{ \App\Helpers\Helpers::shorten($product['description']) }}
            </td>
            <td>
                <img src="{{ asset('storage/uploads/'.$product->thumb) }}" alt="{{ $product->name }}" width="30" height="30">
            </td>
            <td>{{$product['menu']['name']}}</td>
            <td>{{ $product['price'] }}</td>
            <td>{{ $product['price_sale'] }}</td>
            <td>{!! \App\Helpers\Helpers::active($product->active) !!}</td>
            <td>{{ $product['updated_at'] }}</td>
            <td class="d-flex">
                <a href="/admin/products/edit/{{ $product->id}}" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                <a href="/admin/products/edit/{{ $product->id}}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i></a>
                <form action="{{ url('/admin/products/destroy') }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $product['id'] }}">
                    <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-circle-xmark"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>


</table>
<div class="d-flex justify-content-center">
    {{ $products->links('pagination::bootstrap-4') }}
</div>
@endsection
