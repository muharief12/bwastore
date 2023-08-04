<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        $products = Product::with(['galleries'])->orderBy('created_at', 'desc')->paginate(12);

        return view('pages.category', compact('categories','products'));
    }

    public function detail(Request $request, $slug) {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['galleries'])->orderBy('created_at', 'desc')->where('categories_id', $category->id)->paginate(12);

        return view('pages.category', compact('categories','products'));
    }
}
