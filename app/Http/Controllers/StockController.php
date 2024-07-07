<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Brand;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(){
        //$stocks = Stock::orderBy('quantity')->paginate(5);
        $stocks = Stock::join('products', 'products.id', '=', 'stocks.product_id')
        ->join('brands','brands.id','=','products.brand_id')
        ->orderBy('brands.desc', 'asc')->paginate(5);

        return view('stock.index',compact('stocks'));
    }
}
