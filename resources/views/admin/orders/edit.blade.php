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
                <label for="name">Tên Người Mua</label>
                <input disabled  value="{{$order->user->email}}" type="text" class="form-control" id="name">
                <input hidden  value="{{$order->user->email}}" type="text" class="form-control" id="name">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Số Lượng</label>
                <input type="text" name="amount" disabled value="{{$order->amount}}" class="form-control" id="amount" placeholder="Enter amount">
                <input type="text" name="amount" hidden value="{{$order->amount}}" class="form-control" id="amount" placeholder="Enter amount">
                @error('amount')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Giá</label>
                <input type="text" name="total_price" disabled value="{{$order->total_price}}" class="form-control" id="total_price" placeholder="Enter total_price">
                <input type="text" name="total_price" hidden value="{{$order->total_price}}" class="form-control" id="total_price" placeholder="Enter total_price">
                @error('total_price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="note">Ghi chú</label>
                <textarea type="text" name="note"  class="form-control" id="note" placeholder="Ghi chú lại" value="{{$order->note}}" ></textarea>
                @error('note')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-2">
                <img src="{{ asset('storage/uploads/'.$order->product->thumb) }}" alt="img {{ $order->id }}" width="100" height="100">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Update đơn hàng</button>
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
