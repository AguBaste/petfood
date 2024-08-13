<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Configuration;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index()
    {
        $products = Product::select('products.*', 'brands.desc AS brand', 'flavors.desc AS flavor', 'races.desc AS race')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('flavors', 'products.flavor_id', '=', 'flavors.id')
        ->join('races', 'products.race_id', '=', 'races.id')
        ->orderBy('brands.desc')
        ->get();
        $payments = Payment::all();
        $cart = Cart::all();
        return view('cart.index', compact('products', 'cart', 'payments'));
    }




    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'product' => 'required',
            'quantity' => 'required',
        ]);
        $weight = Product::where('id',$request->product)->value('weight');
        $price = Product::where('id',$request->product)->value('price');
        $config = Configuration::first();
        if ($request->quantity == $weight) {
                $price = $price * $config->close;
            } else {
                $price = round($price/ $weight);
                $price *= $config->open;
                $price += (int) $config->expenses;
                $price *= $request->quantity;
            }
        $cart->update([
            'product_id'=> (int)$request->product,
            'quantity'=> floatval($request->quantity),
            'price'=>floatval($price)
        ]);
        return redirect('cart');
    }
    public function store(Request $request)
    {
   

 $request->validate([
            'product' => 'required',
            'amount' => 'required',
        ]);
        // me traigo el producto seleccionado para ver el precio.
        $config = Configuration::first();
        $product = Product::find($request->product);
        
        if (round($product->price*$config->close,-1) == $request->amount) {
            
            $cart = Cart::create([
                'product_id'=> $request->product,
                'quantity'=>$product->weight,
                'price'=>$request->amount
            ]);
           
        } else {
            $product->price = round(($product->price * $config->open + $config->expenses)/$product->weight,-1);
            $quantity = $request->amount / $product->price;
           Cart::create([
                'product_id'=> $request->product,
                'quantity'=>round($quantity,3),
                'price'=>$request->amount
            ]);
        }
        return redirect('cart');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect('cart');
    }
}
