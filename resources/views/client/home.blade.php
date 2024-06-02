@extends('client.layout')

@section('body')
<div class="container" style="position: fixed; margin-top: 100px; z-index: 100;">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
</div>
<!-- Cart -->
@include('client.cart')

<!-- Slider -->
@include('client.slider')

<!-- Banner -->
@include('client.banner')

<!-- Product -->
@include('client.product')

@endsection
