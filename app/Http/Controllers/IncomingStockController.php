<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShoeSize;
use App\Models\IncomingStock;
use App\Models\IncomingTransaction;
use App\Models\Stock;

class IncomingStockController extends Controller
{
    public function index()
    {
        $transactions = IncomingTransaction::paginate(10);
        return view('incoming-stocks.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        $shoeSizes = ShoeSize::all();
        return view('incoming-stocks.create', compact('products', 'shoeSizes'));
    }

    public function receipt($transactionId)
    {
        $transaction = IncomingTransaction::findOrFail($transactionId);
        return view('incoming-stocks.receipt', compact('transaction'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'shoe_size_id' => 'required',
            'quantity' => 'required',
            'supplier_name' => 'required'
        ]);

        $transaction = IncomingTransaction::create([
            'user_id' => auth()->id(),
            'supplier_name' => $request->supplier_name,
        ]);

        // Explode comma separated values
        $productIds = explode(',', $request->product_id);
        $shoeSizeIds = explode(',', $request->shoe_size_id);
        $quantities = explode(',', $request->quantity);

        // Loop through each product id
        foreach ($productIds as $key => $productId) {
            // Create incoming stock
            $incomingStock = IncomingStock::create([
                'product_id' => $productId,
                'shoe_size_id' => $shoeSizeIds[$key],
                'quantity' => $quantities[$key],
                'incoming_transaction_id' => $transaction->id,
            ]);

            // Find stock
            $stock = Stock::where('product_id', $productId)
                ->where('shoe_size_id', $shoeSizeIds[$key])
                ->first();

            // If stock is not found, create a new stock
            if ($stock == null) {
                $stock = Stock::create([
                    'product_id' => $productId,
                    'shoe_size_id' => $shoeSizeIds[$key],
                    'quantity' => 0,
                ]);
            }

            // Increment stock quantity
            $stock->increment('quantity', $quantities[$key]);
        }

        return redirect()->route('incoming-stocks.index')->with('success', 'Incoming stock added successfully.');
    }
}
