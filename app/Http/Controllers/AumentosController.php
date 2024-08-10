<?php

namespace App\Http\Controllers;

use App\Models\Aumento;
use App\Models\Brand;
use App\Models\Configuration;
use App\Models\Product;
use Illuminate\Http\Request;

class AumentosController extends Controller
{
    public function index(){
        $brands = Brand::orderBy('desc','asc' )->paginate(5);
        return view('aumentos.index', compact('brands'));
    }
    public function show($brandId){
        $brands = Brand::all();
        return view('aumentos.show', compact('brandId','brands'));
    }
    public function update($brandId,Request $request){
        $request->validate([
            'valor'=>'required'
        ]);
        $request->valor = '1.'.$request->valor;
        $aumento = $request->valor;
          $products = Product::select('products.*', 'brands.desc AS brand', 'flavors.desc AS flavor', 'races.desc AS race')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('flavors', 'products.flavor_id', '=', 'flavors.id')
            ->join('races', 'products.race_id', '=', 'races.id')
            ->where('products.brand_id', $brandId)
            ->orderBy('races.desc')
            ->get();
            foreach($products as $product){
                $product->update(['price'=> $product->price*$aumento]);
            }
        return redirect(route('products.show',$brandId))->with('status','precios aumentados exitosamente.');
    }
}
