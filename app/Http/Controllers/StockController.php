<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Brand;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // public function index(){
    //     $stocks = Stock::join('products', 'products.id', '=', 'stocks.product_id')
    //     ->join('brands','brands.id','=','products.brand_id')
    //     ->orderBy('brands.desc', 'asc')->paginate(5);
    //     return view('stock.index',compact('stocks'));
    // }
    public function index(){
    $stocks = Stock::join('products', 'products.id', '=', 'stocks.product_id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('races', 'races.id', '=', 'products.race_id')
        ->join('flavors', 'flavors.id', '=', 'products.flavor_id')
        ->orderBy('brands.desc', 'asc')
        ->select('stocks.id as stock_id', 'stocks.quantity', 'products.weight','products.image', 'brands.desc as brand_desc', 'races.desc as race_desc', 'flavors.desc as flavor_desc')
        ->where('quantity','>',0)
        ->paginate(5);
    return view('stock.index', compact('stocks'));
}

    public function edit(Stock $stock){
        return view('stock.edit', compact('stock'));
    }
    public function update(Stock $stock, Request $request){
        $request->validate([
            'bags'=>'required',
            'pounds'=>'required'
        ]);
        // tengo que agregar al stock las bolsas y los kilso pero todo en kilos 
        $nuevosKilos = ($request->bags * $stock->product->weight) + $request->pounds;
        $stock->quantity = $nuevosKilos;
        $stock->update();
        return redirect('stock')->with('status','stock actualizado exitosamente');
    }
}
