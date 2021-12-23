<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$category->title}}</title>
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
                        <a class="nav-link active" aria-current="page" href="/">All Products</a>
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
                        @foreach($categories as $menuCategory)
                            <li><a class="dropdown-item" href="{{route('showCategory', $menuCategory->alias)}}">{{$menuCategory->title}}</a></li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </nav>


{{--INTRO--}}

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">For {{$category->title}}</h1>
            <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
        </div>
    </section>




    {{--PRODUCTS--}}

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                @foreach($category->products as $product)
                    @php
                        $image ='';
                        if (count ($product->images) > 0) {
                            $image = $product->images[0]['img'];
                        } else {
                            $image = 'no_image.jpg';
                        }
                    @endphp
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" src="images/{{$image}}" alt="{{$product->title}}">
                            <div class="card-body">
                                <h5 class="name_item">{{$product->title}}</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text">Availability:</p>
                                @if($product->in_stock)
                                    <h5 style="color: #0aa158">In Stock</h5>
                                @else
                                    <h5 style="color: #e80808">Out of stock</h5>
                                @endif
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-outline-secondary" href="{{route('showProduct', ['gender', $product->id])}}" role="button">View</a>
                                        @if($product->in_stock)
                                            <a class="btn btn-sm btn-outline-secondary" href="{{route('addToCart',['id' => $product->id])}}" data-product-id>Buy</a>
                                        @else
                                            <button type="button" class="btn disabled btn-outline-secondary">Buy</button>
                                        @endif
                                    </div>
                                    <h5 class="text">{{$product->price}} ₴</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</main>

</div>
<script src="/js/jquery-3.6.0.min.js"></script>
<script src="/js/bootstrap.bundle.js"></script>
</body>
</html>
