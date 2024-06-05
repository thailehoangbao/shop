<aside class="col-lg-4 tm-aside-col">
    <div class="tm-post-sidebar">
        <hr class="mb-3 tm-hr-primary">
        <h2 class="mb-4 tm-post-title tm-color-primary">Categories</h2>
        <ul class="tm-mb-75 pl-5 tm-category-list">
            @foreach($categories as $category)
            @if($category->status == 1)
            <li><a href="#" class="tm-color-primary">{{$category->name}}</a></li>
            @endif
            @endforeach

        </ul>
        <hr class="mb-3 tm-hr-primary">
        <h2 class="tm-mb-40 tm-post-title tm-color-primary">Related Posts</h2>
        @foreach($posts as $item)
        @if($item->category_post_id == $post->category_post_id )
        <a href="#" class="d-block tm-mb-40">
            <figure>
                <img src="{{ asset('storage/uploads/'.$item->thumb_1) }}" alt="Image" class="mb-3 img-fluid" width="100" height="80">
                <figcaption class="tm-color-primary">{{$item->sub_title_1}}</figcaption>
            </figure>
        </a>
        @endif
        @endforeach
    </div>
</aside>
