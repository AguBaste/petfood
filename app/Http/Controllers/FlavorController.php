<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Flavor;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;

class FlavorController extends Controller
{
    public function index()
    {
        $flavors = Flavor::orderBy('desc','asc' )->paginate(5);
        return view('flavors.index', compact('flavors'));
    }
    public function show($flavorId)
    {
        $products = Product::whereIn('flavor_id', [$flavorId])->paginate(5);
        $config = Configuration::first();
        $flavor = Flavor::where('id',$flavorId)->first();
        return  view('flavors.show', compact('products', 'config','flavor'));
    }
    public function create()
    {
        return view('flavors.create');
    } 
    public function edit(Flavor $flavor){
        return view('flavors.edit',compact('flavor'));
    }
    public function update(Request $request, Flavor $flavor){
        $flavor->desc = $request->desc;
        $flavor->update();
        return redirect('flavors')->with('status','sabor actualizado exitosamente');
    }
    public function store(Request $request)
    {
        $request->validate([
            'desc'=>'required'
        ]);
        Flavor::firstOrCreate(['desc' => $request->desc]);
        
        return redirect('flavors')->with('status','sabor creado exitosamente');
    }
}
