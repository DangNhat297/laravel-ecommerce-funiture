<!-- mini cart start -->
<div class="sidebar-cart-active">
    <div class="sidebar-cart-all">
        <a class="cart-close" href="#" onclick="return false"><i class="pe-7s-close"></i></a>
        <div class="cart-content">
            <h3>Giỏ Hàng</h3>
            <ul id="mini-cart">
            </ul>
            <div class="cart-total">
                <h4>Tổng tiền: <span id="total-minicart"></span></h4>
            </div>
            <div class="cart-btn btn-hover">
                <a class="theme-color" href="{{ route('cart') }}">Giỏ Hàng</a>
            </div>
            <div class="checkout-btn btn-hover">
                <a class="theme-color" href="{{ route('checkout') }}">Thanh Toán</a>
            </div>
        </div>
    </div>
</div>