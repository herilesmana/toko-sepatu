<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShoeSize;
use App\Models\IncomingStock;
use App\Models\Stock;

class IncomingStockController extends Controller
{
    public function index()
    {
        $incomingStocks = IncomingStock::with('product', 'shoeSize')
        ->paginate(10);
        return view('incoming-stocks.index', compact('incomingStocks'));
    }

    public function create()
    {
        $products = Product::all();
        $shoeSizes = ShoeSize::all();
        return view('incoming-stocks.create', compact('products', 'shoeSizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'shoe_size_id' => 'required|exists:shoe_sizes,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $incomingStock = IncomingStock::create($request->all());

        $stock = Stock::firstOrCreate([
            'product_id' => $request->product_id,
            'shoe_size_id' => $request->shoe_size_id
        ]);

        $stock->increment('quantity', $request->quantity);

        return redirect()->route('incoming-stocks.create')->with('success', 'Incoming stock added successfully.');
    }
}
