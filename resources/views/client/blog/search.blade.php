    <!-- Search form -->
    <div class="row tm-row">
        <div class="col-12">
            <form class="form-inline tm-mb-80 tm-search-form" method="post" action="{{route('blog.search')}}">
                <input class="form-control tm-search-input" name="keyword" type="text" placeholder="Search..." aria-label="Search">
                <button class="tm-search-button" type="submit">
                    <i class="fas fa-search tm-search-icon" aria-hidden="true"></i>
                </button>
                @csrf
            </form>
        </div>
    </div>
