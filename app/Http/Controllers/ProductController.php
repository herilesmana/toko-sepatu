<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('brand', 'category')
        ->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create() {
        $brands = Brand::all();
        $categories = Category::all();
        return view('products.create', compact('brands', 'categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'brand_id' => 'required',
            'category_id' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product) {
        $brands = Brand::all();
        $categories = Category::all();
        return view('products.edit', compact('product', 'brands', 'categories'));
    }

    public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'brand_id' => 'required',
            'category_id' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product) {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function sizes(Product $product)
    {
        $sizes = $product->stocks()->with('shoeSize')->get()->map(function($stock) {
            return [
                'id' => $stock->shoeSize->id,
                'size' => $stock->shoeSize->size,
                'quantity' => $stock->quantity,
            ];
        });

        return response()->json($sizes);
    }

    public function findByBarcode($barcode) {
        $product = Product::where('barcode', $barcode)
        ->with('brand', 'category')
        ->first();
    
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(null, 404);
        }
    }

    public function search(Request $request) {
        $products = Product::where('name', 'like', "%$request->search%")
        ->orWhere('description', 'like', "%$request->search%")
        ->with('brand', 'category')
        // Where brand and category are relationships
        ->orWhereHas('brand', function($query) use ($request) {
            $query->where('name', 'like', "%$request->search%");
        })
        ->orWhereHas('category', function($query) use ($request) {
            $query->where('name', 'like', "%$request->search%");
        })
        ->get();

        return response()->json($products);
    }
}
