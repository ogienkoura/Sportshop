<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
