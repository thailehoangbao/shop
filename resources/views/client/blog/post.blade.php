@extends('client.blog.layout')
@section('content')
<div class="row tm-row">
    <div class="col-lg-8 tm-post-col">
        <div class="container" style="position: fixed; z-index: 100;">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
            </div>
            @endif
        </div>
        <div class="tm-post-full">
            <div class="mb-4">
                <h2 class="pt-2 tm-color-primary tm-post-title">{{$post->title}}</h2>
                <p class="tm-mb-40">Ngày đăng: {{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y H:i:s') }}</p>

                <div>
                    <h5>{{ $post->sub_title_1 ? $post->sub_title_1 : '' }}</h5>
                    <p>{{ $post->content_1 ? $post->content_1 : '' }}</p>
                    <div>
                        @if($post->thumb_1)
                        <img width="600" height="400" src="{{asset('storage/uploads/'.$post->thumb_1)}}" alt="{{$post->title}}">
                        @else
                        <div></div>
                        @endif
                    </div>
                </div>

                <div>
                    <h5>{{ $post->sub_title_2 ? $post->sub_title_2 : '' }}</h5>
                    <p>{{ $post->content_2 ? $post->content_2 : '' }}</p>
                    <div>
                        @if($post->thumb_2)
                        <img width="600" src="{{asset('storage/uploads/'.$post->thumb_2)}}" alt="{{$post->title}}">
                        @else
                        <div></div>
                        @endif
                    </div>
                </div>

                <div>
                    <h5>{{ $post->sub_title_3 ? $post->sub_title_3 : '' }}</h5>
                    <p>{{ $post->content_3 ? $post->content_3 : '' }}</p>
                    <div>
                        @if($post->thumb_3)
                        <img width="600" src="{{asset('storage/uploads/'.$post->thumb_3)}}" alt="{{$post->title}}">
                        @else
                        <div></div>
                        @endif
                    </div>
                </div>

                <span class="d-block text-right tm-color-primary">Chủ đề: {{$post->category_post->name}}</span>
            </div>
            <div class="row tm-row">
                <div class="col-12">
                    <hr class="tm-hr-primary tm-mb-55">
                    {!! $post->video !!}
                </div>
            </div>
            @include('client.blog.comment')
        </div>
    </div>
    @include('client.blog.sidebarright')
</div>
@endsection
