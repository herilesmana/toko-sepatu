<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function getStockBySize($productId, $sizeId) {
        $stock = Stock::where('product_id', $productId)
                      ->where('shoe_size_id', $sizeId)
                      ->first();
    
        return response()->json([
            'product_id' => $productId,
            'shoe_size_id' => $sizeId,
            'quantity' => $stock ? $stock->quantity : 0,
        ]);
    }
    
}
