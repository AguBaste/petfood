<?php


namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Product;
use App\Models\Race;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    public function index()
    {
        $races = Race::orderBy('desc','asc' )->paginate(5);
        return view('races.index', compact('races'));
    }

    public function create()
    {
        return view('races.create');
    }
    public function edit(Race $race){
        return view('races.edit',compact('race'));
    }
    public function update(Request $request, Race $race){
        $race->desc = $request->desc;
        $race->update();
        return redirect('races')->with('status','raza actualizada exitosamente');
    }
    public function show($raceId)
    {
        $products = Product::whereIn('race_id', [$raceId])->paginate(5);
        $config = Configuration::first();

        return  view('races.show', compact('products', 'config'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'desc' => 'required'
        ]);

         Race::firstOrCreate(['desc' => $request->desc]);


        return redirect('races')->with('status','raza registrada exitosamente');
    }
}
