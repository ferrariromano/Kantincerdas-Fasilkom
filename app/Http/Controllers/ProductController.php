<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $query = Product::where('status', 'Aktif');
        $products = $query->get();

        return view('menu/index',
            ['active' => 'menu'],
            compact('products')
        );
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

}
