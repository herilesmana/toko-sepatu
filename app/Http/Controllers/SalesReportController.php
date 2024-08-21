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

        return view('reports.sales', compact('data', 'year', 'month'));
    }
}
