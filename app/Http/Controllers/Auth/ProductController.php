<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::active()->with('category')->paginate(12);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function byCategory(Category $category)
    {
        $products = $category->products()->where('is_active', true)->paginate(12);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories', 'category'));
    }
}