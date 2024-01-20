<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        //Get 8 latest product
        $featuredProducts = Product::latest()->take(8)->get();

        return view('client.pages.home')->with('featuredProducts', $featuredProducts);
    }
}
