<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn Hàng Của Bạn</title>
</head>

<body>
    <a href="http://127.0.0.1:8001/except-order/{{$id}}/{{$token}}">
        <button style="background-color: green; padding: 4px; border-radius: 2px; cursor: pointer;">Bấm vào để xác nhận đơn hàng</button>
    </a>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>User_Name</th>
                <th>Hình Ảnh</th>
                <th>Size</th>
                <th>Color</th>
                <th>Price</th>
                <th>Ghi chú</th>
                <th>Updated_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lists as $key => $list)
            <tr>
                <td>{{ $list['id'] }}</td>
                <td>{{ $list->user->email }}</td>
                <td>
                    <img src="{{ asset('storage/uploads/'.$list->product->thumb) }}" alt="{{ $list->product->name }}" width="30" height="30">
                </td>
                <td>{{ $list['size'] }}</td>
                <td>{{ $list['color'] }}</td>
                <td>{{ $list->product->price }}</td>
                <th>{{ $list->note}} </th>
                <td>{{ $list['updated_at'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
