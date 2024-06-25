@extends('client.layout')

@section('body')
@include('client.alertsuccess')
@include('client.alerterror')
<!-- Cart -->
@include('client.cart')

<!-- Slider -->
@include('client.slider')

<!-- Counter -->
@include('client.countnumber')

<!-- Banner -->
@include('client.banner')

<!-- Product -->
@include('client.product')

@endsection
