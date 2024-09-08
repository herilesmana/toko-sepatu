<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index()
    {
        $year = request('year');
        $month = request('month');

        $data = SaleItem::with('product', 'shoeSize', 'sale');

        if ($year) {
            $data->whereHas('sale', function ($query) use ($year) {
                $query->whereYear('created_at', $year);
            });
        }

        if ($month) {
            $data->whereHas('sale', function ($query) use ($month) {
                $query->whereMonth('created_at', $month);
            });
        }

        $data = $data->get();

        $total = $data->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $sumQTY = $data->sum('quantity');

        // Bar chart data for which product sold the most with product name and quantity
        $chartData = $data->groupBy('product_id')->map(function ($item) {
            return [
                'product' => $item->first()->product->name,
                'quantity' => $item->sum('quantity')
            ];
        });

        return view('reports.sales', compact('data', 'year', 'month', 'total', 'chartData', 'sumQTY'));
    }
}
