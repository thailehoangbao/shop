<!DOCTYPE html>
<html lang="en">

<head>
    @include('client.blog.head')
</head>
<body>
    @include('client.blog.header')
    <div class="container-fluid">
        <main class="tm-main">
            @include('client.blog.search')
            @yield('content')
        </main>
    </div>
    @include('client.blog.footer')
    @include('client.blog.foot')
</body>
</html>
