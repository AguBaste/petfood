<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Flavor;
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

        return  view('flavors.show', compact('products', 'config'));
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
        return view('layout.exito');
    }
    public function store(Request $request)
    {
        $request->validate([
            'desc'=>'required'
        ]);
        Flavor::firstOrCreate(['desc' => $request->desc]);
        
        return redirect('flavors');
    }
}
