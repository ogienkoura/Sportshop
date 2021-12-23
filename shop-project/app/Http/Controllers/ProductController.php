<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show ($gender, $product_id) {
        $item = Product::where('id',$product_id)->first();

        return view('product.show', [
            'item' => $item
        ]);
    }

    public function showCategory ($category_alias) {
        $category = Category::where('alias', $category_alias)->first();


        return view('categories.index',[
            'category' => $category
        ]);
    }


}
