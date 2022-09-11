<header class="header-area header-responsive-padding header-height-1">
    <div class="header-bottom sticky-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="/assets/client/images/logo/logo.png" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="main-menu text-center">
                        <nav>
                            <ul>
                                <li><a href="{{ route('home') }}">TRANG CHỦ</a></li>
                                <li><a href="{{ route('shop') }}">CỬA HÀNG</a></li>
                                <li><a href="{{ route('contact') }}">LIÊN HỆ</a></li>
                                <li><a href="{{ route('post.list') }}">BLOG</a></li>
                                <li><a href="{{ route('track') }}">ĐƠN HÀNG</a></li>
                                @role('super-admin')
                                <li><a href="{{ route('admin.dashboard') }}">QUẢN TRỊ</a></li>
                                @endrole
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="header-action-wrap">
                        <div class="header-action-style header-search-1">
                            <a class="search-toggle" href="#">
                                <i class="pe-7s-search s-open"></i>
                                <i class="pe-7s-close s-close"></i>
                            </a>
                            <div class="search-wrap-1">
                                <form action="{{ route('shop') }}">
                                    <input placeholder="Tìm kiếm sản phẩm" name="q" type="text">
                                    <button class="button-search"><i class="pe-7s-search"></i></button>
                                </form>
                            </div>
                        </div>
                        @if (!auth()->check())
                        <div class="header-action-style">
                            <a title="Login" href="{{ route('auth.login') }}"><i class="pe-7s-user"></i></a>
                        </div> 
                        @endif
                        @if (auth()->check())
                        <div class="header-action-style">
                            <a title="Profile" href="{{ route('profile.index') }}"><i class="pe-7s-user"></i></a>
                        </div> 
                        <div class="header-action-style">
                            <a title="Logout" href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        </div>
                        @endif
                        <div class="header-action-style header-action-cart">
                            <a class="cart-active" href="#"><i class="pe-7s-shopbag"></i>
                                <span class="product-count bg-black"></span>
                            </a>
                        </div>
                        <div class="header-action-style d-block d-lg-none">
                            <a class="mobile-menu-active-button" href="#"><i class="pe-7s-menu"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>