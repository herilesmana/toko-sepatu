<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ShoeSize;
use App\Models\Stock;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalBrands = Brand::count();
        $totalCategories = Category::count();
        $totalShoeSizes = ShoeSize::count();
        $totalStocks = Stock::sum('quantity');

        return view('dashboard', compact('totalProducts', 'totalBrands', 'totalCategories', 'totalShoeSizes', 'totalStocks'));
    }
}
