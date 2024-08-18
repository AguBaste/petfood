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
        $brand = Brand::where('id',$brandId)->first();
        return view('aumentos.show', compact('brandId','brand'));
    }
    public function update($brandId,Request $request){
        $request->validate([
            'valor'=>'required',
            'type'=>'required'
        ]);
        if ($request->valor < 10) {
            $valor = '1.0'.$request->valor;
        }else{
            $valor = '1.'.$request->valor;
        }
        //$valor = '1.'.$request->valor;
        
          $products = Product::select('products.*', 'brands.desc AS brand', 'flavors.desc AS flavor', 'races.desc AS race')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('flavors', 'products.flavor_id', '=', 'flavors.id')
            ->join('races', 'products.race_id', '=', 'races.id')
            ->where('products.brand_id', $brandId)
            ->orderBy('races.desc')
            ->get();

            //si el type es * lo aumento 
            if ($request->type == 'aumentar') {
                foreach($products as $product){
                $product->update(['price'=> $product->price*$valor]);
            }
                return redirect(route('products.show',$brandId))->with('status','precios aumentados exitosamente.');
            }else {
                foreach($products as $product){
                $product->update(['price'=> $product->price/$valor]);
            }
                return redirect(route('products.show',$brandId))->with('status','precios disminuidos exitosamente.');
    }   
    }
}
