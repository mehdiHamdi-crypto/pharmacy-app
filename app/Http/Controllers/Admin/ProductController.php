<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
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

        if ($status = $request->input('status')) {
            match ($status) {
                'active' => $query->where('is_active', true),
                'inactive' => $query->where('is_active', false),
                'low' => $query->whereBetween('stock', [1, 10]),
                'out' => $query->where('stock', 0),
                default => null,
            };
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        $stockStats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'low_stock' => Product::whereBetween('stock', [1, 10])->count(),
            'out_of_stock' => Product::where('stock', 0)->count(),
            'total_units' => (int) Product::sum('stock'),
        ];

        return view('admin.products.index', compact('products', 'categories', 'stockStats'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $product = new Product();

        return view('admin.products.create', compact('categories', 'product'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $this->persistImage($request, $data);

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit cree avec succes.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request, $product);
        $this->persistImage($request, $data, $product);

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit mis a jour avec succes.');
    }

    public function destroy(Product $product)
    {
        if ($product->orderItems()->exists()) {
            return back()->with('error', 'Impossible de supprimer un produit deja present dans une commande. Desactivez-le plutot.');
        }

        if ($this->isLocalStoragePath($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit supprime.');
    }

    public function toggle(Product $product)
    {
        $product->update(['is_active' => ! $product->is_active]);

        return back()->with('success', 'Statut mis a jour.');
    }

    private function validated(Request $request, ?Product $product = null): array
    {
        $skuRules = $product
            ? ['nullable', 'string', 'max:100', Rule::unique('products', 'sku')->ignore($product)]
            : ['nullable', 'string', 'max:100', 'unique:products,sku'];

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sku' => $skuRules,
            'description' => 'nullable|string|max:5000',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'image_upload' => 'nullable|image|max:4096',
            'image_url' => 'nullable|string|max:2048',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['image_url'] = trim((string) ($data['image_url'] ?? '')) ?: null;

        if (empty($data['sku'])) {
            $data['sku'] = $product?->sku ?: $this->generateSku();
        }

        unset($data['image_upload']);

        return $data;
    }

    private function persistImage(Request $request, array &$data, ?Product $product = null): void
    {
        if ($request->hasFile('image_upload')) {
            if ($product && $this->isLocalStoragePath($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }

            $data['image_url'] = $request->file('image_upload')->store('products', 'public');

            return;
        }

        if (
            $product
            && $this->isLocalStoragePath($product->image_url)
            && $data['image_url'] !== $product->image_url
        ) {
            Storage::disk('public')->delete($product->image_url);
        }
    }

    private function isLocalStoragePath(?string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return false;
        }

        return Storage::disk('public')->exists($path);
    }

    private function generateSku(): string
    {
        do {
            $sku = 'PHC-' . Str::upper(Str::random(6));
        } while (Product::where('sku', $sku)->exists());

        return $sku;
    }
}