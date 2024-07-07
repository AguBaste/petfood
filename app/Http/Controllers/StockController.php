<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Brand;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(){
        $stocks = Stock::orderBy('quantity')->paginate(5);
        //return $stock;
        return view('stock.index',compact('stocks'));
    }
}
