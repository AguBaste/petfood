<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductsSales;
use App\Models\Purchase;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __invoke()
    {

        $mes = date('m');
        $dia = date('d');
        $anio = date('Y');
        $salesDia = Sale::selectRaw('SUM(total) as total, DAY(created_at) as day, MONTH(created_at) as month, YEAR(created_at) as year')
            ->whereDay('created_at', $dia)
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $anio)
            ->groupBy('day', 'month', 'year')
            ->get();

        $sales = Sale::selectRaw('SUM(total)as total, MONTH(created_at) as month, YEAR(created_at) as year')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $anio)
            ->groupBy('month', 'year')
            ->get();

        $purchases = Purchase::selectRaw('SUM(total)as total, MONTH(created_at) as month, YEAR(created_at) as year')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $anio)
            ->groupBy('month', 'year')
            ->get();

        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();
        $topSellingProducts = ProductsSales::select([
            'products_sales.product_id','products.image',
            DB::raw('SUM(products_sales.quantity) as total_sales')
        ])
            ->join('products', 'products_sales.product_id', '=', 'products.id')
            ->join('sales', 'products_sales.id', '=', 'sales.id')
            ->whereBetween('sales.created_at',[$firstDayOfMonth,$lastDayOfMonth])
            ->groupBy('products_sales.product_id','products.image')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get();
        return view('dashboard', compact('sales', 'salesDia', 'purchases', 'topSellingProducts'));
    }
}
