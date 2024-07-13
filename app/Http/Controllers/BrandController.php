<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('desc', 'asc')->paginate(5);
 
        //return $cantidadPorMarca;
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }
    public function edit(Brand $brand){
        return view('brands.edit',compact('brand'));
    }
    public function update(Request $request,Brand $brand){
        $brand->desc = $request->desc;
        $brand->update();
        return view('layout.exito');
    }
    public function store(Request $request)
    {
        $request->validate([
            'desc' => 'required'
        ]);
        Brand::firstOrCreate(['desc' => $request->desc]);

        return redirect('brands');
    }
    public function show(String $brand){
        $brand = Brand::where('brands.desc',$brand)->first();
        return $brand;
    }
}
