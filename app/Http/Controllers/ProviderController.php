<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::all();
        return view('providers.index', compact('providers'));
    }

    public function create()
    {
        return view('providers.create');
    }

    public function edit(Provider $provider){ 
       return view('providers.edit',compact('provider'));
     }
     public function update(Request $request, Provider $provider){
        $request->validate([    
            'name'=>'required',
            'phone'=>'required'
        ]);
        $provider->name = $request->name;
        $provider->phone = $request->phone;
        $provider->update();
        return redirect('providers')->with('status','proveedor actualizado exitosamente');
     }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required'
        ]);
        $provider = new Provider();
        $provider->name = $request->name;
        $provider->phone = $request->phone;

        $provider->save();
        return redirect('providers')->with('status','proveedor registrado exitosamente');
    }
}
