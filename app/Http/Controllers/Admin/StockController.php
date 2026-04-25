<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($categoryId = $request->input('category')) {
            $query->where('category_id', $categoryId);
        }

        if ($filter = $request->input('filter')) {
            match ($filter) {
                'low' => $query->whereBetween('stock', [1, 10]),
                'out' => $query->where('stock', 0),
                'available' => $query->where('stock', '>', 10),
                default => null,
            };
        }

        $products = $query->orderBy('stock')->orderBy('name')->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        $summary = [
            'total_products' => Product::count(),
            'low_stock' => Product::whereBetween('stock', [1, 10])->count(),
            'out_of_stock' => Product::where('stock', 0)->count(),
            'total_units' => (int) Product::sum('stock'),
        ];

        return view('admin.stock.index', compact('products', 'categories', 'summary'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'mode' => 'required|in:set,add,remove',
            'quantity' => 'required|integer|min:0',
        ]);

        $quantity = (int) $data['quantity'];

        $newStock = match ($data['mode']) {
            'set' => $quantity,
            'add' => $product->stock + $quantity,
            'remove' => max(0, $product->stock - $quantity),
        };

        $product->update(['stock' => $newStock]);

        return back()->with('success', 'Stock mis a jour pour ' . $product->name . '.');
    }
}