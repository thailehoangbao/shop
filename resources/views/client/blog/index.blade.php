@extends('client.blog.layout')
@section('content')
<div class="row tm-row">
    @foreach($posts as $post)
    <article class="col-12 col-md-6 tm-post">
        <hr class="tm-hr-primary">
        <a href="post/{{$post->id}}" class="effect-lily tm-post-link tm-pt-60">
            <div class="tm-post-link-inner">
                <img src="{{asset('storage/uploads/'.$post->thumb_1)}}" alt="{{$post->title}}" class="img-fluid" style="height: 300px;">
            </div>
            <span class="position-absolute tm-new-badge">New</span>
            <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{$post->title}}</h2>
        </a>
        <p class="tm-pt-30">
            {{ \App\Helpers\Helpers::shortenHasValue($post['content_1'],50) }}
        </p>
        <div class="d-flex justify-content-between tm-pt-45">
            @if($post->category_post)
            <span class="tm-color-primary">{{$post->category_post['name']}}</span>
            @else
            <span class="tm-color-primary">No category</span>
            @endif
            <span class="tm-color-primary">{{$post->created_at}}</span>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <span>
                {{ App\Helpers\Helpers::sumComments($comments,$post) }} Comments
            </span>
            <span>write by {{$post->user->name}}</span>
        </div>
    </article>
    @endforeach

</div>
<div class="row tm-row tm-mt-100 tm-mb-75">
    <div class="tm-prev-next-wrapper">
        <a href="#" class="mb-2 tm-btn tm-btn-primary tm-prev-next disabled tm-mr-20">Prev</a>
        <a href="#" class="mb-2 tm-btn tm-btn-primary tm-prev-next">Next</a>
    </div>
    <div class="tm-paging-wrapper">
        <span class="d-inline-block mr-3">Page</span>
        <nav class="tm-paging-nav d-inline-block">
            <ul>
                <li class="tm-paging-item active">
                    <a href="#" class="mb-2 tm-btn tm-paging-link">1</a>
                </li>
                <li class="tm-paging-item">
                    <a href="#" class="mb-2 tm-btn tm-paging-link">2</a>
                </li>
                <li class="tm-paging-item">
                    <a href="#" class="mb-2 tm-btn tm-paging-link">3</a>
                </li>
                <li class="tm-paging-item">
                    <a href="#" class="mb-2 tm-btn tm-paging-link">4</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

@endsection
