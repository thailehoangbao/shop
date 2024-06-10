<!-- Modal Search -->
<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
    <div class="container-search-header">
        <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
            <img src="/template/client/images/icons/icon-close2.png" alt="CLOSE">
        </button>

        <form class="wrap-search-header flex-w p-l-15" method="post" action="{{route('search.product')}}">
            <button class="flex-c-m trans-04" type="submit">
                <i class="zmdi zmdi-search"></i>
            </button>
            <input class="plh3" type="text" name="keyword" placeholder="Search...">
            @csrf
        </form>
    </div>
</div>
