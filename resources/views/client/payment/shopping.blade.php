<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85" action="" method="post">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1 text-center" style="padding-left: 20px!important;">Hình Ảnh</th>
                                <th class="column-2 text-center" style="width: 300px;">Name</th>
                                <th class="column-3 text-center">Price</th>
                                <th class="column-4 text-center">Discount</th>
                                <th class="column-5 text-center">Amount</th>
                                <th class="column-6 text-center">Last_Price</th>
                            </tr>

                            @foreach($lists as $item)
                            <tr class="table_row">
                                <td class="column-1" style="padding-left: 20px!important;">
                                    <div class="how-itemcart1">
                                        <img src="{{ asset('storage/uploads/'.$item->product->thumb) }}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2 text-center" style="width: 300px;">{{ $item->product->name }}</td>
                                <td class="column-3 text-center">{{number_format($item->product->price)}}</td>
                                <td class="column-4 text-center">{{$item->product->price_sale}}%</td>
                                <td class="column-5 text-center">
                                    {{ $item->amount }}
                                </td>
                                <td class="column-6 text-center">{{number_format($item->total_price)}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">

                            <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                Apply coupon
                            </div>
                        </div>

                        <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                            Your Cart
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                {{ number_format(\App\Helpers\Helpers::totalPrice($lists)) }} VND
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Shipping:
                            </span>
                        </div>

                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <p class="stext-111 cl6 p-t-2">
                                Free Ship 0đ
                            </p>




                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Your info :
                            </span>
                        </div>

                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <p class="stext-111 cl10 p-t-2">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="stext-111 cl10 p-t-2">
                                {{ Auth::user()->email }}
                            </p>

                            <p class="stext-111 cl6 p-t-2">
                                <label for="phone" class="cl10">Phone: </label>
                                <input type="text" placeholder="Enter your phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger" style="font-size: 14px;user-select: none;">{{ $message }}</div>
                                @enderror
                            </p>



                            <p class="stext-111 cl6 p-t-2">
                                <label for="address" class="cl10">Address: </label>
                                <input type="text" placeholder="Enter your address" name="address" value="{{ old('address') }}">
                                @error('address')
                                <div class="text-danger" style="font-size: 14px;user-select: none;">{{ $message }}</div>
                                @enderror
                            </p>

                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                {{ number_format(\App\Helpers\Helpers::totalPrice($lists)) }} VND
                            </span>
                        </div>
                    </div>


                    <input type="hidden" name="lists" value="{{ json_encode($lists) }}">
                    <input hidden type="text" name="last_total" value="{{ \App\Helpers\Helpers::totalPrice($lists) }}">

                    <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Thanh Toán
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>
