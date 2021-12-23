<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Darryldecode\Cart\Cart;

class NewInvoice extends Invoice
{
    public function getInvoice (float $sum): self
    {

        $hash = $this->generateHash();

        $invoice = self::query()
            ->where('user_id',Auth::user()->id)
            ->where('hash',$hash)
            ->where('status',self::STATUS_NEW)
            ->first();


        if (empty($invoice)) {
            $invoice= new self();
            $invoice->user_id = Auth::user()->id;
            $invoice->hash = $hash;
            $invoice->status = self::STATUS_NEW;
        }
        $invoice->amount = $sum;
        $invoice->save();
        return $invoice;

    }

    private function generateHash (): string
    {
        $userId = Auth::user()->id;
        $date = date('Y-m-d');
        return md5("{$userId}::{$date}");
    }
}
