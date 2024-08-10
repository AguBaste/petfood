<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index(){
        $config = Configuration::first();
        return view('configurations.index', compact('config'));
    }
    public function create(){
        return view('configurations.create');
    }
    public function store(Request $request){
        $request->validate([
            'close'=>'required',
            'open'=>'required',
            'expenses'=>'required' 
        ]);

        $config = new Configuration();
        $config->open = $request->open;
        $config->close = $request->close;
        $config->expenses = $request->expenses;
        $config->save();
        return redirect('configurations');
    }
    public function edit(){
        $config = Configuration::first();
        return view('configurations.edit',compact('config'));
    }
    public function update(Request $request, Configuration $config){
        $request->validate([
            'open'=>'required',
            'close'=>'required',
            'expenses'=>'required'
        ]);
        $open = '1.'.$request->open;
        $close = '1.'.$request->close;
        $config = Configuration::first();
        $config->open = $open;
        $config->close = $close;
        $config->expenses = $request->expenses;
        
        $config->save();

        return redirect('configurations')->with('status','configuraciones actualizadas exitosamente');
    }
}
