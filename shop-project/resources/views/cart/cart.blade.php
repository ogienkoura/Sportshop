<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- JavaScript Bundle with Popper -->
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>--}}

</head>
<body>


{{--HEADER--}}

<div class="container mt-3" id="main-container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success" href="{{route('cartIndex')}}">Cart <span class="badge bg-secondary">{{\Cart::session(\Illuminate\Support\Facades\Session::getId())->getTotalQuantity()}}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Log Out</a>
                    </li>
                </ul>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach($categories as $category)
                            <li><a class="dropdown-item" href="{{route('showCategory', $category->alias)}}">{{$category->title}}</a></li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </nav>




    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <table class="table table-image">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($cart as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td class="w-25">
                            <img src="/images/{{$item->attributes->img}}" class="img-fluid img-thumbnail" alt="{{$item->title}}">
                        </td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->price}} ₴</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->price * $item->quantity}} ₴</td>
                        <td><a class="btn btn-danger" href="{{route('deleteItemCart', $item->id)}}">Delete</a></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="6"></td>
                        <td class="fw-bold">Total Price: {{$sum}} ₴</td>
                    </tr>
                    </tbody>
                </table>
                {!!   $liqpay->cnb_form(array(
            'action'         => 'pay',
            'amount'         => $sum,
            'currency'       => 'UAH',
            'description'    => 'Payment for sport items',
            'order_id'       => $invoice->id,
            'version'        => '3',
            'result_url'     => '',
            'server_url'     => ''
        )) !!}
            </div>
        </div>
    </div>




    {{--LIQPAY--}}





</div>

<script src="/js/jquery-3.6.0.min.js"></script>
<script src="/js/bootstrap.bundle.js"></script>
<script src="/js/buy.js"></script>
</body>
</html>
