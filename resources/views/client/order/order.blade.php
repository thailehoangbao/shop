@extends('client.order.layout')
@section('order')
<div class="container m-t-100">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lịch sử đơn hàng</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Hình Ảnh</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Amount</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->product->name}}</td>
                                <td>
                                    <img src="{{ asset('storage/uploads/'.$order->product->thumb) }}" alt="{{ $order->product->name }}" width="30" height="30">
                                </td>
                                <td>{{$order->size}}</td>
                                <td>{{$order->color}}</td>
                                <td>{{$order->amount}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    <a href="{{route('orders.detail',[$order->id])}}">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
