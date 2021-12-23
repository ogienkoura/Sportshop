<?php

namespace App\Http\Controllers;

use DenizTezcan\LiqPay\Support\LiqPay;
use Darryldecode\Cart\Cart;

class LiqPayController extends Controller
{
    protected $client = null;

    public function __construct()
    {
        $this->client = new LiqPay(config('liqpay.public_key'), config('liqpay.private_key'));
    }


    public function pay(
        $amount 		= 1,
        $currency 		= 'UAH',
        $description 	= 'Payment for sport items',
        $order_id 		= "bar",
        $result_url     = "",
        $server_url     = ""
    ) {
        $form = $this->client->cnb_form(array(
            'action'         => 'pay',
            'amount'         => $amount,
            'currency'       => $currency,
            'description'    => $description,
            'order_id'       => $order_id,
            'version'        => '3',
            'result_url'     => $result_url,
            'server_url'     => $server_url
        ));


        $script = '<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script><script type="text/javascript">jQuery(document).ready(function($) {$("form").submit();});</script> ';

        return $html = $form.$script;
    }

    public function status($invoiceId)
    {
        $data = $this->client->api("request", array(
            'action'        => 'status',
            'version'       => '3',
            'order_id'      => $invoiceId
        ));
        return json_encode($data, TRUE);

    }

}
