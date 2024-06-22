<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    Free shipping for standard order over 500.000VND
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        Help & FAQs
                    </a>

                    <a href="/my-account" class="flex-c-m trans-04 p-lr-25">
                        My Account
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        EN
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        USD
                    </a>
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="/" class="logo__client">
                    <img src="{{ asset('images/miumiustore_transparent.png') }}" alt="IMG-LOGO" width="120" height="60" >
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu"><a href="/">Trang Chủ</a></li>

                        @foreach($menus as $key => $menu)
                        @if($menu->parent_id == 0)
                        <li>
                            <a href="#">{{ $menu->name }}</a>
                            <ul class="sub-menu">
                                @foreach($menus as $menuChild)
                                @if($menuChild->parent_id == $menu->id)
                                <li><a href="/category/{{ $menuChild->id }}">{{ $menuChild->name }}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach

                        <li><a href="/blog/info">Blog</a></li>
                        <li><a href="/about/info">About</a></li>
                        <li><a href="/contact/info">Contact</a></li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
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


                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{$amounts}}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                </div>
            </nav>
        </div>
    </div>

    @include('client.headermobile')

    @include('client.modalsearch')
</header>
