<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lấy lại mật khẩu</title>
</head>
<body>
    <h1 style="font-size: large; font-weight: 500;">Xin chào! {{$user->name}} .Vui lòng click vào nút xác nhận lấy lại mật khẩu email của bạn!</h1>
    <button style="padding: 4px 8px; border: 1px solid transparent; cursor: pointer; background-color: #888; border-radius: 4px;">
        <a href="{{route('reset.password',['id'=>$user,'token'=>$token])}}" style="text-decoration: none;color: white;">Xác nhận lấy lại mật khẩu</a>
    </button>
</body>
</html>
