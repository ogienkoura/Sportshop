<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
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
            </div>
        </div>
    </nav>

    <div class="card mt-5" style="width: 18rem;">
        @php
            $image ='';
            if (count ($item->images) > 0) {
                $image = $item->images[0]['img'];
            } else {
                $image = 'no_image.jpg';
            }
        @endphp
        <img src="/images/{{$image}}" alt="{{$item->title}}">
        <div class="card-body">
            <h5 class="card-title">{{$item->title}}</h5>
            <p class="card-text">{{$item->description}}</p>
            <h5 class="text">{{$item->price}} ₴</h5>
            @if($item->in_stock)
            <a href="{{route('addToCart',['id' => $item->id])}}" class="btn btn-primary" data-product-id>Buy</a>
            @else
            <a href="#" class="btn disabled btn-primary" >Buy</a>
            @endif
        </div>
    </div>


</div>

<script src="/js/jquery-3.6.0.min.js"></script>
<script src="/js/bootstrap.bundle.js"></script>
<script>
    $('#main-container').Buy();
</script>
</body>
</html>
