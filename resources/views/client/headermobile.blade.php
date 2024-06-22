    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile ">
            <a href="/" class="logo__client"><img src="{{ asset('images/miumiustore_transparent.png') }}" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div id="auth-link">
                <!-- Blade kiểm tra xem người dùng đã đăng nhập hay chưa -->
                @if (Auth::check())
                <div>
                    <a id="logout-link" href="{{ route('client.logout') }}" class="cl2 hov-cl1 trans-04 p-l-22 p-r-11" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng Xuất</a>
                    <form id="logout-form" action="{{ route('client.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button>
                        <a href="/profile/info"><i class="fa-solid fa-user"></i></a>
                    </button>
                </div>
                @else
                <a href="{{ route('login') }}" class="cl2 hov-cl1 trans-04 p-l-22 p-r-11">Đăng Nhập</a>
                @endif
            </div>


            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="{{$amounts}}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Free shipping for standard order over 500.000VND
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        Help & FAQs
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        My Account
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        EN
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        USD
                    </a>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="/">Home</a>
                <ul class="sub-menu-m">
                    @foreach($menus as $key => $menu)
                    @if($menu->parent_id == 0)
                    <li>
                        <a href="/parentCategory/{{$menu->id}}">{{ $menu->name }}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li><a href="/blog/info">Blog</a></li>
            <li><a href="/about/info">About</a></li>
            <li><a href="/contact/info">Contact</a></li>
        </ul>
    </div>
