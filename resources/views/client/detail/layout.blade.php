@extends('client.layout')

@section('body')
    @include('client.detail.cart')

    @yield('detail')

@endsection
