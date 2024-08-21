<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\IncomingStock;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\ShoeSize;
use App\Models\Stock;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalBrands = Brand::count();
        $totalCategories = Category::count();
        $totalShoeSizes = ShoeSize::count();
        $totalStocks = Stock::sum('quantity');

        $totalSales = Sale::count();
        $totalSalesToday = Sale::whereDate('created_at', Carbon::today())->count();
        $recentSales = Sale::with('items.product')->orderBy('created_at', 'desc')->take(5)->get();

        $year = date('Y');
        $month = date('m');

        $currentMonthSale = SaleItem::with('product', 'shoeSize', 'sale')
        ->whereHas('sale', function ($query) use ($year, $month) {
            $query->whereYear('created_at', $year)
            ->whereMonth('created_at', $month);
        })->get();

        // Current month incoming stock
        $currentMonthIncomingStock = IncomingStock::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->with('product', 'shoeSize')
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalBrands',
            'totalCategories',
            'totalShoeSizes',
            'totalStocks',
            'totalSales',
            'totalSalesToday',
            'recentSales',
            'currentMonthSale',
            'currentMonthIncomingStock'
        ));
    }
}
