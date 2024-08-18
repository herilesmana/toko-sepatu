<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockReportController extends Controller
{
    public function index()
    {
        $stockReport = Product::select('products.name as product_name', 'shoe_sizes.size as shoe_size', 'stocks.quantity as stock_quantity')
            ->join('stocks', 'products.id', '=', 'stocks.product_id')
            ->join('shoe_sizes', 'stocks.shoe_size_id', '=', 'shoe_sizes.id')
            ->orderBy('products.name')
            ->orderBy('shoe_sizes.size')
            ->get();

        return view('reports.stock', compact('stockReport'));
    }
}
