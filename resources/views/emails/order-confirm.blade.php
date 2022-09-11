
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Xác Nhận Đơn Hàng | Funiture Ecommerce</title>
    <style>
        *{
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            background: rgb(226, 226, 226);
        }
        .container{
            width: 700px;
            margin: 10px auto;
            background: #fff;
        }
        .heading-top {
            padding: 40px;
            text-align: center;
            font-weight: bold;
            font-size: 2rem;
            background-image: url(https://i.imgur.com/atXrYp4.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            font-family: cursive;
            color: #fff;
            border-radius: 3px 3px 0 0;
        }
        .information{
            font-size: 1rem;
            text-transform: uppercase;
            padding: 30px;
            display: inline-block;
            width: 100%;
            border-bottom: 0.5px solid #ff9d88;
        }
        .information > .col{
            flex:1;
        }
        .font-weight-bold{
            font-weight: bold;
            margin-bottom: 10px;
        }
        .opacity-70{
            opacity: 0.7 !important;
        }
        .table-order-detail{
            padding: 10px 30px;
            margin: 10px 0;
        }
        table.order-detail{
            width: 100%;
            font-size: 1rem;
            border-collapse: collapse;
        }
        .text-left{
            text-align: left !important;
        }
        .text-right{
            text-align: right !important;
        }
        table.order-detail thead th{
            text-transform: uppercase;
            opacity: 0.7;
            padding: 5px;
            font-weight: bold;
            border-bottom: 2px solid rgb(207, 207, 207);
        }
        table.order-detail tbody td{
            font-weight: bold;
            text-align: center; 
            padding: 10px;
        }
        .text-color-pink{
            color: #ff9d88 !important;
        }
        .text-color-danger{
            color: rgb(241, 205, 2) !important;
        }
        table.order-detail tfoot{
            border-top: 2px solid rgb(207, 207, 207);
        }
        table.order-detail tfoot th{
            padding: 10px;
            font-weight: bold;

        }
        .footer{
            padding: 10px;
            background: #ff9d88;
            color: #fff;
            text-align: center;
            font-weight: bold;
        }
        .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0; 
        }
        .btn-subscribe-order{
            outline: none;
            border: none;
            display: block;
            text-align: center;
            margin: 10px auto;
            padding: 10px 20px;
            border-radius: 10px;
            background: #fff;
            text-decoration: none;
            transition: all .2s linear
        }
        a{
            text-decoration: none
        }
        .btn-subscribe-order:hover{
            background: #f1f1f1;
        }
    </style>
</head>
<body>
    <span class="preheader">Đơn hàng mới trên Funiture Ecommerce</span>
    <div class="container">
        <div class="heading-top">Funiture Ecommerce</div>
        <div class="information">
            <div class="col" style="float:left">
                <div class="font-weight-bold">Ngày đặt hàng</div>
                <span class="opacity-70">{{ $order->created_at->format("d-m-Y \l\ú\c H:i") }}</span>
            </div>
            <div class="col" style="float: right;">
                <div class="font-weight-bold">Địa chỉ thanh toán.</div>
                <span class="opacity-70">{{ $order->fullname }}</span><br>
                <span class="opacity-70">{{ $order->phone }}</span><br>
                <span class="opacity-70">{{ $order->email }}</span><br>
                <span class="opacity-70">{{ $order->address }}</span><br>
                <span class="opacity-70">{{ $order->note }}</span>
            </div>
        </div>
        <div class="table-order-detail">
            <table class="order-detail">
                <thead>
                    <tr>
                        <th class="text-left">Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tùy chọn</th>
                        <th class="text-right">Tạm tính</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $product)
                    <tr>
                        <td class="text-left">{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ productPrice($product->pivot->price) }}</td>
                        <td>{{ $product->pivot->options ?? 'Không' }}</td>
                        <td class="text-right">{{ productPrice($product->pivot->price*$product->pivot->quantity) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-left">Trạng thái</th>
                        <th class="text-right text-color-danger" colspan="3">{{ config("common.order_status.{$order->status}") }}</th>
                    </tr>
                    <tr>
                        <th class="text-left">Tổng thanh toán</th>
                        <th class="text-right" colspan="3">{{ productPrice($order->products->sum(fn($v) => $v->pivot->price*$v->pivot->quantity)) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="footer">Xin cảm ơn !
            <a href="{{ route('track', ['id' => $order->id]) }}"><button class="btn btn-subscribe-order">THEO DÕI ĐƠN HÀNG</button></a>
        </div>
    </div>
</body>
</html>