@extends('admin.layout')

@section('content')
<table class="table">

    <thead>
        <tr>
            <th>Id</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Status</th>
            <th>List</th>
            <th>Last_total</th>
            <th>Updated_at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $key => $payment)
        <tr>
            <td>{{ $payment['id'] }}</td>
            <td>{{ $payment->phone }}</td>
            <td>{{ $payment->address }}</td>
            <td>
                {!! App\Helpers\Helpers::statusPayment($payment->status) !!}
            </td>
            <td>
                <form action="{{ url('/admin/payments/detail') }}" method="get" >
                    @csrf
                    <input type="hidden" name="list" value="{{ $payment['list'] }}">
                    <button type="submit" class="text-primary"> show detail</button>
                </form>
            </td>
            <td>{{ number_format($payment->last_total) }}</td>
            <td>{{ $payment['updated_at'] }}</td>
            <td class="d-flex">
                <a href="/admin/payments/edit/{{ $payment->id}}" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                <a href="/admin/payments/edit/{{ $payment->id}}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i></a>
                <form action="{{ url('/admin/payments/destroy') }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $payment['id'] }}">
                    <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-circle-xmark"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>


</table>
<div class="d-flex justify-content-center">
    {{ $payments->links('pagination::bootstrap-4') }}
</div>
@endsection
