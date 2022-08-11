<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="Urdan Minimal eCommerce Bootstrap 5 Template is a stunning eCommerce website template that is the best choice for any online store.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="canonical" href="https://htmldemo.hasthemes.com/urdan/index.html" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Urdan - Minimal eCommerce HTML Template" />
    <meta property="og:url" content="https://htmldemo.hasthemes.com/urdan/index.html" />
    <meta property="og:site_name" content="Urdan - Minimal eCommerce HTML Template" />
    <!-- For the og:image content, replace the # with a link of an image -->
    <meta property="og:image" content="#" />
    <meta property="og:description" content="Urdan Minimal eCommerce Bootstrap 5 Template is a stunning eCommerce website template that is the best choice for any online store." />
    <!-- Add site Favicon -->
    <link rel="icon" href="/assets/client/images/favicon/cropped-favicon-32x32.png" sizes="32x32" />
    <link rel="icon" href="/assets/client/images/favicon/cropped-favicon-192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="/assets/client/images/favicon/cropped-favicon-180x180.png" />
    <meta name="msapplication-TileImage" content="/assets/client/images/favicon/cropped-favicon-270x270.png" />

    <!-- All CSS is here
	============================================ -->
    <link rel="stylesheet" href="/assets/client/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/client/css/vendor/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="/assets/client/css/vendor/themify-icons.css" />
    <link rel="stylesheet" href="/assets/client/css/vendor/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/client/css/plugins/animate.css" />
    <link rel="stylesheet" href="/assets/client/css/plugins/aos.css" />
    <link rel="stylesheet" href="/assets/client/css/plugins/magnific-popup.css" />
    <link rel="stylesheet" href="/assets/client/css/plugins/swiper.min.css" />
    <link rel="stylesheet" href="/assets/client/css/plugins/jquery-ui.css" />
    <link rel="stylesheet" href="/assets/client/css/plugins/nice-select.css" />
    <link rel="stylesheet" href="/assets/client/css/plugins/select2.min.css" />
    <link rel="stylesheet" href="/assets/client/css/plugins/easyzoom.css" />
    <link rel="stylesheet" href="/assets/client/css/plugins/slinky.css" />
    {{-- @livewireStyles --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.css" integrity="sha512-yq+qDDTUuLA4zvJjuvcpV809SNmM0ReTyeadKsNvW0cSvGVfj3K20SdlkburwJHHdzuGDtFElBcxndjd7J3nrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/client/css/plugins/rateit.css" />
    <link rel="stylesheet" href="/assets/client/css/style.css" />
    <link rel="stylesheet" href="/assets/client/css/custom.css" />
</head>




<body>
    <div class="main-wrapper main-wrapper-2">
        <div class="pre-loading">
            <div class="spinner-loader"></div>
        </div>
        @include('layouts.client.header')

        @include('layouts.client.mini-cart')

        @hasSection ('breadcrumb')
        <div class="breadcrumb-area bg-gray-4 breadcrumb-padding-1">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h2 data-aos="fade-up" data-aos-delay="200">@yield('breadcrumb')</h2>
                    <ul data-aos="fade-up" data-aos-delay="400">
                        <li><a href="/">Trang chủ</a></li>
                        <li><i class="ti-angle-right"></i></li>
                        <li>@yield('breadcrumb')</li>
                    </ul>
                </div>
            </div>
            <div class="breadcrumb-img-1" data-aos="fade-right" data-aos-delay="200">
                <img src="/assets/client/images/breadcrumb-1.webp" alt="">
            </div>
            <div class="breadcrumb-img-2" data-aos="fade-left" data-aos-delay="200">
                <img src="/assets/client/images/breadcrumb-2.webp" alt="">
            </div>
        </div>
        @endif

        @yield('content')
        
        @include('layouts.client.footer')

        <!-- Product Modal start -->
        <div class="modal fade quickview-modal-style" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><i class=" ti-close "></i></a>
                    </div>
                    <div class="modal-body">
                        <div class="row gx-0">
                            <div class="col-lg-5 col-md-5 col-12">
                                <div class="modal-img-wrap">
                                    <img src="/assets/client/images/product/quickview.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-12">
                                <div class="product-details-content quickview-content">
                                    <h2>New Modern Chair</h2>
                                    <div class="product-details-price">
                                        <span class="old-price">$25.89 </span>
                                        <span class="new-price">$20.25</span>
                                    </div>
                                    <div class="product-details-review">
                                        <div class="product-rating">
                                            <i class=" ti-star"></i>
                                            <i class=" ti-star"></i>
                                            <i class=" ti-star"></i>
                                            <i class=" ti-star"></i>
                                            <i class=" ti-star"></i>
                                        </div>
                                        <span>( 1 Customer Review )</span>
                                    </div>
                                    <div class="product-color product-color-active product-details-color">
                                        <span>Color :</span>
                                        <ul>
                                            <li><a title="Pink" class="pink" href="#">pink</a></li>
                                            <li><a title="Yellow" class="active yellow" href="#">yellow</a></li>
                                            <li><a title="Purple" class="purple" href="#">purple</a></li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare tincidunt neque vel semper. Cras placerat enim sed nisl mattis eleifend.</p>
                                    <div class="product-details-action-wrap">
                                        <div class="product-quality">
                                            <input class="cart-plus-minus-box input-text qty text" name="qtybutton" value="1">
                                        </div>
                                        <div class="single-product-cart btn-hover">
                                            <a href="#">Add to cart</a>
                                        </div>
                                        <div class="single-product-wishlist">
                                            <a title="Wishlist" href="#"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="single-product-compare">
                                            <a title="Compare" href="#"><i class="pe-7s-shuffle"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Modal end -->
        
        @include('layouts.client.nav-mobile')

    </div>
    <!-- All JS is here -->
    <script src="/assets/client/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="/assets/client/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="/assets/client/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <script src="/assets/client/js/vendor/popper.min.js"></script>
    <script src="/assets/client/js/vendor/bootstrap.min.js"></script>
    <script src="/assets/client/js/plugins/wow.js"></script>
    <script src="/assets/client/js/plugins/scrollup.js"></script>
    <script src="/assets/client/js/plugins/aos.js"></script>
    <script src="/assets/client/js/plugins/magnific-popup.js"></script>
    <script src="/assets/client/js/plugins/jquery.syotimer.min.js"></script>
    <script src="/assets/client/js/plugins/swiper.min.js"></script>
    <script src="/assets/client/js/plugins/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/client/js/plugins/isotope.pkgd.min.js"></script>
    <script src="/assets/client/js/plugins/jquery-ui.js"></script>
    <script src="/assets/client/js/plugins/jquery-ui-touch-punch.js"></script>
    <script src="/assets/client/js/plugins/jquery.nice-select.min.js"></script>
    <script src="/assets/client/js/plugins/waypoints.min.js"></script>
    <script src="/assets/client/js/plugins/counterup.min.js"></script>
    <script src="/assets/client/js/plugins/select2.min.js"></script>
    <script src="/assets/client/js/plugins/easyzoom.js"></script>
    <script src="/assets/client/js/plugins/slinky.min.js"></script>
    <script src="/assets/client/js/plugins/ajax-mail.js"></script>
    {{-- @livewireScripts --}}
    <script src="/assets/client/js/plugins/jquery.rateit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.js" integrity="sha512-lfP7VHOp6XS4CDxn82+BZ3narDVFMXjxy3yTQIcTxjpea9R77LM2VSWQn+qemnpR43d9+ogbMEfSc6OtzKQilA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Main JS -->
    <script src="/assets/client/js/main.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            }
        })
        function miniCart(){
            $.ajax({
                url: '{{ route("cart") }}',
                success: function(res){
                    let data = res.data.map(value => {
                        return `<li data-id="${value.id}">
                                    <div class="cart-img">
                                        <a href="#"><img src="/${value.thumb}" alt=""></a>
                                    </div>
                                    <div class="cart-title">
                                        <h4><a href="#">${value.product.name}</a></h4>
                                        <span> ${value.quantity} × ${value.price}	</span>
                                    </div>
                                    <div class="cart-delete">
                                        <a href="#">×</a>
                                    </div>
                                </li>`
                    })
                    $('#mini-cart').html(data.join(''))
                    $('#total-minicart').html(res.total)
                    $('.cart-active .product-count').text(data.length)
                    setTimeout(() => {
                        if(typeof fetchCart !== 'undefined') fetchCart()
                    },500)
                }
            })
        }

        miniCart()

        function deleteCartItem(id){
            let _url = '{{route('cart.delete',':id')}}'
            _url = _url.replace(':id', id)
            $.ajax({
                url: _url,
                type: 'DELETE',
                dataType: 'json',
                success: function(res){
                    if(res.status){
                        Swal.fire({
                            position: 'top-right',
                            icon: 'success',
                            title: 'Đã xóa sản phẩm khỏi giỏ hàng',
                            showConfirmButton: false,
                            timer: 1300,
                            timerProgressBar: true
                        })
                    }
                }
            })
        }

        $(document).on('click', '.cart-delete a', function(e){
            e.preventDefault()
            let id = $(this).closest('li').data('id')
            deleteCartItem(id)
            setTimeout(() => {
                miniCart()
            }, 500);
        })

        function addToCart(id, quantity = 1){
            let options = []
            let _url = '{{route('cart.add',':id')}}'
            _url = _url.replace(':id', id)
            $.ajax({
                url: _url,
                type: 'POST',
                data: {
                    quantity: quantity,
                    options: options.join('/')
                },
                success: function(response, textStatus, jqXHR) {
                    if (jqXHR.status == 201) {
                        if(response.status){
                            Swal.fire({
                                position: 'top-right',
                                icon: 'success',
                                title: 'Đã thêm vào giỏ hàng',
                                showConfirmButton: false,
                                timer: 1300,
                                timerProgressBar: true
                            })
                            miniCart()
                        }
                    }

                },
                error: function(jqXHR) {
                    console.log(jqXHR.responseText)
                }
            })  
        }

        $('.add-to-cart').click(function(){
            let id = $(this).data('product-id')
            addToCart(id)
        })
    </script>
    <script src="/assets/client/js/custom.js"></script>
    @yield('custom-js-tag')
</body>

</html>