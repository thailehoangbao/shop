@extends('client.layout')

@section('body')
<!-- Product -->
<div class="bg0 m-t-100 p-b-140">
    <div class="container">
        @include('client.category.navbar')

        @include('client.category.cart')
        @yield('contentCategory')


        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Load More
            </a>
        </div>
    </div>

</div>
@endsection
