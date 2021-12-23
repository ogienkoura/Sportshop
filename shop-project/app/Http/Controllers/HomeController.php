<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function main()
    {
        $products = Product::all();

        return view('layouts.main', [
            'products' => $products
        ]);

    }
}

