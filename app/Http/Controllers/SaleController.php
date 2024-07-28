<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShoeSize;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Stock;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('items.product', 'items.shoeSize')
        ->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        $shoeSizes = ShoeSize::all();
        return view('sales.create', compact('products', 'shoeSizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.shoe_size_id' => 'required|exists:shoe_sizes,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $totalAmount = 0;
        foreach ($request->items as $item) {
            $totalAmount += $item['quantity'] * $item['price'];
        }

        $sale = Sale::create(['total_amount' => $totalAmount]);

        foreach ($request->items as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'shoe_size_id' => $item['shoe_size_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            $stock = Stock::where('product_id', $item['product_id'])
                ->where('shoe_size_id', $item['shoe_size_id'])
                ->first();

            if ($stock) {
                $stock->decrement('quantity', $item['quantity']);
            }
        }

        return redirect()->route('sales.index')->with('success', 'Sale transaction completed successfully.');
    }

    public function show(Sale $sale)
    {
        $sale->load('items.product', 'items.shoeSize');
        return view('sales.show', compact('sale'));
    }
}
