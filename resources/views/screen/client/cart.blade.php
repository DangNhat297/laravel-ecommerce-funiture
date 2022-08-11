@extends('layouts.client.master')

@section('title', 'Giỏ hàng')

@section('breadcrumb', 'Giỏ hàng')

@section('content')
    <div class="cart-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="cart-table-content">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="width-thumbnail"></th>
                                            <th class="width-name">Sản phẩm</th>
                                            <th class="width-price"> Giá</th>
                                            <th class="width-quantity">Số lượng</th>
                                            <th class="width-subtotal">Tạm tính</th>
                                            <th class="width-remove"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-cart">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update btn-hover">
                                        <a href="#">Tiếp tục mua sắm</a>
                                    </div>
                                    <div class="cart-clear-wrap">
                                        {{-- <div class="cart-clear btn-hover">
                                        <button>Update Cart</button>
                                    </div> --}}
                                        <div class="cart-clear btn-hover">
                                            <a href="#">Xóa giỏ hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row d-flex justify-content-end">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="grand-total-wrap">
                        <div class="grand-total-content">
                            <div class="grand-total">
                                <h4>Tổng tiền: <span id="total"></span></h4>
                            </div>
                        </div>
                        <div class="grand-total-btn btn-hover">
                            <a class="btn theme-color" href="{{ route('checkout') }}">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js-tag')
    <script>
        // get table
        function fetchCart() {
                $.ajax({
                    headers: {
                        'Accept': 'application/json'
                    },
                    url: '{{ route('cart') }}',
                    success: function(res) {
                        console.log(res)
                        data = res.data.map(item => {
                            let _url =
                                '{{ route('product', ['slug' => ':slug', 'id' => ':id']) }}'
                            _url = _url.replace(':slug', item.product.slug)
                            _url = _url.replace(':id', item.product.id)
                            return `<tr data-id="${item.id}">
                                    <td class="product-thumbnail">
                                        <a href="${_url}"><img src="/${item.thumb}" alt=""></a>
                                    </td>
                                    <td class="product-name">
                                        <h5><a href="${_url}">
                                            ${item.product.name}
                                            <p>${item.options ?? ''}</p>
                                            </a></h5>
                                    </td>
                                    <td class="product-cart-price"><span class="amount">${item.price}</span></td>
                                    <td class="cart-quality">
                                        <div class="product-quality">
                                            <div class="dec qtybutton">-</div>
                                            <input class="cart-plus-minus-box input-text qty text" name="qtybutton" value="${item.quantity}">
                                            <div class="inc qtybutton">+</div>
                                        </div>
                                    </td>
                                    <td class="product-total"><span>${item.subtotal}</span></td>
                                    <td class="product-remove"><a href=""><i class=" ti-trash "></i></a></td>
                                </tr>`
                        })
                        $('#data-cart').html(data.join(''))
                        $('#total').html(res.total)
                    }
                })
            }
        $(document).ready(function() {

            fetchCart()

            // update quantity

            $(document).on('change', '[name="qtybutton"]', function() {
                let id = $(this).closest('tr').data('id')
                let value = $(this).val()
                let _url = '{{ route('cart.update', ['id' => ':id']) }}'
                _url = _url.replace(':id', id)
                $.ajax({
                    url: _url,
                    type: 'PUT',
                    data: {
                        quantity: value
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == true) {
                            fetchCart()
                            miniCart()
                        }
                    }
                })
            })

            // delete item
            $(document).on('click', '.product-remove a', function(e) {
                e.preventDefault()
                let id = $(this).closest('tr').data('id')
                deleteCartItem(id)
                setTimeout(() => {
                    fetchCart()
                    miniCart()
                }, 500);
            })

            // clear cart
            $(document).on('click', '.cart-clear a', function(e) {
                e.preventDefault()
                Swal.fire({
                    title: 'Bạn có chắc muốn xóa hết giỏ hàng?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa ngay!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('cart.clear') }}',
                            method: 'DELETE',
                            dataType: 'json',
                            success: function(res){
                                if(res.status){
                                    Swal.fire({
                                        position: 'top-right',
                                        icon: 'success',
                                        title: 'Xóa giỏ hàng thành công',
                                        showConfirmButton: false,
                                        timer: 1300,
                                        timerProgressBar: true
                                    })
                                    fetchCart()
                                }
                            }
                        })
                    }
                })
            })

        })
    </script>
@endsection
