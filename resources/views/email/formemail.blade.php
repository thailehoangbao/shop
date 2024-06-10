<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn Hàng Của Bạn</title>
</head>

<body>
    <div>
        <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 12px;">
            <a href="http://127.0.0.1:8001/except-order/{{$id}}/{{$token}}">
                <button style="color: black ;background-color: #f3f3f3; padding: 4px; border-radius: 3px; cursor: pointer;border: 1px solid transparent">Bấm vào để xác nhận đơn hàng</button>
            </a>
        </div>
        <table class="table" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Id</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">User_Name</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Hình Ảnh</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Size</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Color</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Price</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Ghi chú</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Updated_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lists as $key => $list)
                <tr>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $list['id'] }}</td>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $list->user->email }}</td>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">
                        <img src="{{ asset('storage/uploads/'.$list->product->thumb) }}" alt="{{ $list->product->name }}" width="30" height="30">
                    </td>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $list['size'] }}</td>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $list['color'] }}</td>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $list->product->price }}</td>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $list->note }}</td>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $list['updated_at'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
