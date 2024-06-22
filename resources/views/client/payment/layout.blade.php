@extends('client.layout')
@section('body')
	<!-- Cart -->
    @include('client.cart')

    @yield('payment')

@endsection





