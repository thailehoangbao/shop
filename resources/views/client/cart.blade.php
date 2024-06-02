<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">

            <ul class="header-cart-wrapitem w-full">
                @foreach($lists as $item)
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="{{ asset('storage/uploads/'.$item->product->thumb) }}" alt="{{$item->product->name}}">
                    </div>

                    <div class="header-cart-item-txt p-t-8">
                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            {{ $item->product->name }}
                        </a>

                        <span class="header-cart-item-info">
                            {{ $item->amount }} x {{ $item->product->price }} = {{ $item->amount * $item->product->price }} VND
                            <form action="{{ url('/orders/destroy') }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button type="submit" class="text-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </span>
                    </div>
                </li>
                @endforeach

            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: {{ \App\Helpers\Helpers::totalPrice($lists) }} VND
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <form action="{{ route('payment.index') }}" method="get">
                        @csrf
                        <!-- <input type="hidden" name="lists" value="{{ json_encode($lists) }}"> -->
                        <button type="submit" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            View Cart
                        </button>
                    </form>

                    <form action="{{ route('orders.index')}}" method="get">
                        @csrf
                        <button type="submit" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Check Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
