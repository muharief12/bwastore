<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $active = 'Home';
        $categories = Category::take(6)->get();
        $products = Product::with('galleries')->take(8)->orderBy('created_at', 'desc')->get();

        return view('pages.home', compact('active', 'products', 'categories'));
    }
}
