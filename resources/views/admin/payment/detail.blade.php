<!DOCTYPE html>
<html>
<head>
    <title>Thông Tin Đơn Hàng</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h4>THÔNG TIN ĐƠN HÀNG</h4>
    <table>
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Name</th>
                <th>Hình Ảnh</th>
                <th>Amount</th>
                <th>Last_price</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order['id'] }}</td>
                <td>{{ $order['product']['name'] }}</td>
                <td><img src="{{ asset('storage/uploads/'.$order['product']['thumb']) }}" width="80px" height="80px"></td>
                <td>{{ $order['amount'] }}</td>
                <td>{{ number_format($order['total_price']) }} VND</td>
                <td>{{ App\Helpers\Helpers::formatDate($order['created_at']) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p style="text-align: end;">
        <strong>Tổng tiền: </strong> {{ number_format(App\Helpers\Helpers::totalPrice2($orders)) }} VND
    </p>
</body>
</html>
