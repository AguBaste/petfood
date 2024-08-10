<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expenses::orderBy('created_at','desc')
        ->get();
        return view('expenses.index',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'desc'=>'required',
            'price'=>'required' 
        ]);
        Expenses::create([
            'desc'=> $request->desc,
            'price'=> floatval($request->price)
        ]);
        return redirect('expenses')->with('status','gasto registrado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expenses $expenses)
    {
        return view('expenses.show',compact('expenses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expenses $expenses)
    {
        $expenses->delete();
        return redirect('expenses')->with('status','gasto eliminado exitosamente');
    }
}
