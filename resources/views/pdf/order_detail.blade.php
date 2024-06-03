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
                <th>ID</th>
                <th>Name</th>
                <th>Hình Ảnh</th>
                <th>Size</th>
                <th>Color</th>
                <th>Amount</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->product->name }}</td>
                <td><img src="{{ assert('public/uploads/' . $order->product->thumb) }}" width="60"></td>
                <td>{{ $order->size }}</td>
                <td>{{ $order->color }}</td>
                <td>{{ $order->amount }}</td>
                <td>{{ $order->created_at }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
