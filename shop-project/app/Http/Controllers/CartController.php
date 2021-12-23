<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use DenizTezcan\LiqPay\Support\LiqPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LiqPayController;
use App\Models\NewInvoice;





class CartController extends Controller
{
    public function index() {

        $sessionId = Session::getId();
        $cart= \Cart::session($sessionId)->getContent();
        $sum =\Cart::getTotal('price');
        $invoice = (new NewInvoice())->getInvoice($sum);


        $client = new LiqPay(config('liqpay.public_key'), config('liqpay.private_key'));


        return view('cart.cart',[
            'cart' => $cart,
            'sum' => $sum,
            'liqpay' => $client,
            'invoice' => $invoice,
        ]);
    }

    public function addToCart (Request $request) {

        $product = Product::query()->where(['id' => $request->id])->first();
        $sessionId = Session::getId();

        \Cart::session($sessionId)->add([
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'img' => isset($product->images[0]->img) ? $product->images[0]->img : 'no_image.png'
            ],
        ]);

        $cart = \Cart::getContent();


        return redirect()->back();

    }

    public function deleteItemCart($itemId) {
        $sessionId = Session::getId();
        \Cart::session($sessionId)->remove($itemId);
        return back();
    }

}
