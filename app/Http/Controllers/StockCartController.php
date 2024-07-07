<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\StockCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StockCartController extends Controller
{
    public function index()
    {
        $products = Product::select('products.*', 'brands.desc AS brand', 'flavors.desc AS flavor', 'races.desc AS race')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('flavors', 'products.flavor_id', '=', 'flavors.id')
            ->join('races', 'products.race_id', '=', 'races.id')
            ->orderBy('brands.desc')
            ->get();
        $providers = Provider::all();
        // aca deberia ser stock:all()
        $stockCart = StockCart::all();
        $total =0;
        foreach($stockCart as $item){
            $cant = $item->quantity/$item->product->weight;
           $total +=  $item->price*$cant;
        }  
        return view('stockCart.index', compact('products', 'providers','stockCart','total'));
    }
    public function edit(StockCart $stockCart){
        $products = Product::select('products.*', 'brands.desc AS brand', 'flavors.desc AS flavor', 'races.desc AS race')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('flavors', 'products.flavor_id', '=', 'flavors.id')
        ->join('races', 'products.race_id', '=', 'races.id')
        ->orderBy('brands.desc')
        ->get();
        $providers = Provider::all();
        return view('stockCart.edit',compact('products','providers','stockCart'));
    }
    public function update(Request $request,StockCart $stockCart){
        $request->validate([
            'product'=>'required',
            'quantity'=>'required',
            'price'=>'required', 
            'provider'=>'required'
        ]);
        $stockCart->update([
            'product_id'=> (int)$request->product,
            'quantity'=> floatval($request->quantity),
            'price'=>floatval($request->price* $request->quantity),
            'provider'=>(int)$request->provider
        ]);
        return redirect('stockCart');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required',
            'quantity' => 'required',
            'price'=>'required',
        ]);
      
        $stockCart = new StockCart();
        $stockCart->product_id =(int)$request->product;
        $stockCart->price = floatval($request->price);
        $stockCart->quantity = floatval($request->quantity);
        $stockCart->save();
        $stockCarts = StockCart::all();  
         
        return redirect('stockCart');
    }
    public function destroy(StockCart $stockCart)
    {
        $stockCart->delete();
        return redirect('stockCart');
    }
}
