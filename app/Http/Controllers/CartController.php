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


    public function edit(Cart $cart)
    {
        $products = Product::select('products.*', 'brands.desc AS brand', 'flavors.desc AS flavor', 'races.desc AS race')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('flavors', 'products.flavor_id', '=', 'flavors.id')
        ->join('races', 'products.race_id', '=', 'races.id')
        ->orderBy('brands.desc')
        ->get();
        return view('cart.edit', compact('cart', 'products'));
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
    //     $request->validate([
    //         'product' => 'required',
    //         'quantity' => 'required',
    //     ]);
    //     // me traigo el producto seleccionado para ver el precio.

    //     $weight = Product::where('id',$request->product)->value('weight');
    //     $price = Product::where('id',$request->product)->value('price');
    //     $config = Configuration::first();
    //     $cart = new Cart();
    //     $cart->product_id = (int)$request->product;
    //     $cart->quantity = floatval($request->quantity);
    //     //aca tengo que validar si los kilos son iguales a la bolsa cerrada

    //     if ($cart->quantity% $weight == 0) {
    //         $cant = $cart->quantity/ $weight;
    //         $cart->price = ($price*$cant) * $config->close;
    //     } else {
    //         $cart->price = round($price / $weight);
    //         $cart->price *= $config->open;
    //         $cart->price += (int) $config->expenses;
    //         $cart->price *= $cart->quantity;
    //     }
    //      $cart->price = round($cart->price);

    //     $cart->save();
    //     return redirect('cart');
    // }

 $request->validate([
            'product' => 'required',
            'amount' => 'required',
        ]);
        // me traigo el producto seleccionado para ver el precio.
        $config = Configuration::first();
        $product = Product::select('weight as peso','price as precio')
        ->where('products.id',$request->product)->first();

        if ($product->precio*$config->close == $request->amount) {
            $product->precio = ($product->precio * $config->close);
            $cart = Cart::create([
                'product_id'=> $request->product,
                'quantity'=>$product->peso,
                'price'=>$product->precio 
            ]);
        } else {
            $product->precio = round(($product->precio * $config->open + $config->expenses)/$product->peso,-1);
            $quantity = $request->amount / $product->precio;
            $cart = Cart::create([
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
