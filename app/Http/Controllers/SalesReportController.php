<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index()
    {
        $data = SaleItem::with('product', 'shoeSize', 'sale')
            ->get();

        return view('reports.sales', compact('data'));
    }
}
