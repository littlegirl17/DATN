<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private $productModel;


    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function checkout()
    {
        return view('checkout');
    }
}
