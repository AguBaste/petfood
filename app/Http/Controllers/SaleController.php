<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Stock;
use App\Models\ProductsSales;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class SaleController extends Controller
{
    public function index(Request $request)
    {     
        if($request->has('date')){
            $request->validate([
                'date'=>'required|date'
            ]);
            list($year,$month) = explode('-',$request->input('date'));
            $sales = Sale::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->orderByDesc('created_at')
            ->paginate(5)
            ->withQueryString(); 
            $total = Sale::whereMonth('created_at',$month)->sum('total');

        } else{
            //inicio con sales vacio
            $sales= collect();
            $total = 0;
        }

        return view('sales.index',compact('sales','total'));
      
    }
    public function show(Sale $sale)
    {
        $detailSale = ProductsSales::where('sale_id', $sale->id)
        ->groupBy('sale_id', 'product_id', 'quantity', 'price', 'created_at', 'updated_at', 'id')
        ->get();
        return view('sales.show', compact('detailSale', 'sale'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'payment' => 'required'
        ]);
        //recibo el carrito 
        $cart = json_decode($request->input('cart'), true);

        $total = 0;
        //obtengo el total del carrito 
        foreach ($cart as $item) {
            $total += $item['price'];
        }
        if ($total == 0) {
            return redirect('cart');
        }
        //hago una nueva venta 
        $sale = new Sale();


        $sale->total = $total;
        $sale->payment_id = $request->payment;
        $sale->save();

        $saleId = $sale->id;
        //inserto en la tabla pivote con el mismo id de la tabla sales 
        foreach ($cart as $item) {
            DB::table('products_sales')->insert([
                'sale_id' => $saleId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
            $product = Stock::where('product_id',$item['product_id'])->get();
            if($product->isEmpty()){
                $nuevo = new Stock();
                $nuevo->product_id = $item['product_id'];
                $nuevo->quantity = $item['quantity'];
                $nuevo->save();
            }else{
                $product[0]->quantity -= $item['quantity'];
                $product[0]->save();
            }

        }

        //borro el carrito 
        foreach ($cart as $item) {
            Cart::where('id', $item['id'])->delete();
        }

        //regreso a la vista principal 
        return redirect('cart');
    }
}
