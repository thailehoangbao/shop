@extends('client.profile.layout')
@section('body')
<section class="content m-t-100">
    <div class="container" style="position: fixed; margin-top: 100px; z-index: 100;">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
        </div>
        @endif
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('client.profile.avatar')
                @include('client.profile.about')
            </div>
            <!-- /.col -->
            @include('client.profile.content')
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection
