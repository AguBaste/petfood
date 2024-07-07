<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductsPurchase;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\StockCart;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
class PurchaseController extends Controller
{
    public function index(Request $request)
    {     
        if($request->has('date')){
            $request->validate([
                'date'=>'required|date'
            ]);
            list($year,$month) = explode('-',$request->input('date'));
            $purchases = Purchase::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->orderByDesc('created_at')
            ->paginate(5)
            ->withQueryString(); 
        $total = Purchase::whereMonth('created_at',$month)->sum('total');

        } else{
            //inicio con sales vacio
            $purchases= collect();
            $total =0;
        }
                     
        return view('purchases.index',compact('purchases','total'));
      
    }
    public function show(Purchase $purchase){
        $detailPurchase = ProductsPurchase::where('purchase_id',$purchase->id)->groupBy('purchase_id','product_id','quantity','price','created_at','updated_at','id')->get(); 
        return view('purchases.show',compact('detailPurchase','purchase'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'provider'=>'required'
        ]);
        //recibo el carrito 
        $stockCart = json_decode($request->input('stockCart'), true);

        $total = 0;
        //obtengo el total del carrito 
        foreach ($stockCart as $item) {
            //comparo el precio de compra del producto con el precio anterior
            $precioViejo = Product::select('products.price')->where('products.id',$item['product']['id'])->get();
            if($item['price'] != $precioViejo){
                $product = Product::find($item['product']['id']);
                if ($product) {
                    $product->update(['price' => $item['price']]); // Update the price
                } 
            }
            $cant =$item['quantity']/$item['product']['weight'];
            $total += $item['price']*$cant;
        }
        if ($total == 0) {
            return redirect('stockCart');
        }
        //hago una nueva venta 
        $purchase = new Purchase();
        $purchase->total = $total;

        $purchase->provider_id = $request->provider;
        $purchase->save();

        $purchaseId = $purchase->id;

        foreach ($stockCart as $item) {
            DB::table('products_purchases')->insert([
                'purchase_id' => $purchaseId,
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
                $product[0]->quantity += $item['quantity'];
                $product[0]->save();
            }

            
        }


        foreach ($stockCart as $item) {
            StockCart::where('id', $item['id'])->delete();
        }

        //regreso a la vista principal 
        return redirect('stockCart');

    }
}
