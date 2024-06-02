<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận tài khoản</title>
</head>
<body>
    <h1>Thông tin xác nhận tài khoản {{$user->name}}</h1>
    <button style="background: green; border: 1px solid transparent; color:white; padding: 8px 6px; border-radius: 4px;">
        <a style="color: white; text-decoration: none;" href="http://127.0.0.1:8001/confirm-register/{{$token}}">Bấm để xác nhận tài khoản</a>
    </button>
</body>
</html>
