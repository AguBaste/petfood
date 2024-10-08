<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Configuration;
use App\Models\Flavor;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Race;
use App\Models\Provider;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Decimal;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Product $products, Configuration $config,Stock $stock)
    {

        return view('products.index', compact('config', 'products','stock'));
    }
    public function show($brandId)
    {
        $brand = Brand::where('id',$brandId)->first();
        $products = Product::select('products.*', 'brands.desc AS brand', 'flavors.desc AS flavor', 'races.desc AS race')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('flavors', 'products.flavor_id', '=', 'flavors.id')
            ->join('races', 'products.race_id', '=', 'races.id')
            ->where('products.brand_id', $brandId)
            ->orderBy('races.desc')
            ->paginate(5);
        $config = Configuration::first();
        return  view('products.index', compact('products', 'config','brand'));
    }
    public function details(Product $product)
    {
        $stock = Stock::where('product_id',$product->id)->first();
        $config = Configuration::first();
        return view('products.details', compact('product', 'config','stock'));
    }
    public function complete(Product $product)
    {

        return $product;
    }
    public function valor(Product $product)
    {
        $price =  $product->price;
        $config = Configuration::first();
        $data=[]; 
        $data['bolsa'] = round($price*$config->close,-1);
        $data['kilo'] =  round(($price / $product->weight) * $config->open + $config->expenses, -1) ;
        $data['image'] = $product->image;
        return $data;
    }

    public function create()
    {
        $brands = Brand::orderBy('desc', 'asc')->get();
        $races = Race::orderBy('desc','asc')->get();
        $flavors = Flavor::orderBy('desc','asc')->get();
        return view('products.create',compact('brands','races','flavors'));

    }
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'race' => 'required',
            'flavor' => 'required',
            'weight' => 'required',
            'image' => 'required',
            'price' => 'required',
        ]);
        if ($request->file('image')) {
            $manager = new ImageManager(new Driver());
            $image_name = $request->brand . $request->race . $request->flavor . $request->weight.'.webp';
            $img = $manager->read($request->file('image'));
            //$img = $img->resize(370, 246);
            $img->toWebp(80)->save(base_path('public/upload/' . $image_name));
            //$save_url = 'upload/product/' . $image_name;

        }
        $product = Product::firstOrCreate([
            'brand_id' => (int)$request->brand,
            'race_id' => (int)$request->race,
            'flavor_id' => (int)$request->flavor,
            'weight' => floatval($request->weight),
            'price' => floatval($request->price),
            'image' => $image_name
        ]);
        $config = Configuration::first();
        return redirect(route('products.details',compact('product')))->with('status','producto creado exitosamente');
    }

    public function edit(Product $product)
    {
        $brands = Brand::all();
        $races = Race::all();
        $flavors = Flavor::all();
        return view('products.edit', compact('product', 'brands', 'races', 'flavors'));
    }

    public function update(Product $product, Request $request,)
    {
        $request->validate([
            'brand' => 'required',
            'race' => 'required',
            'flavor' => 'required',
            'weight' => 'required',
            'price' => 'required'
        ]);
        $product->brand_id = (int)$request->brand;
        $product->race_id = (int)$request->race;
        $product->flavor_id = (int)$request->flavor;
        $product->weight = floatval($request->weight);
        $product->price = floatval($request->price);
        if ($request->file('image')) {
            $manager = new ImageManager(new Driver());
            $image_name = $request->brand . $request->race . $request->flavor . $request->weight.'.webp';
            $img = $manager->read($request->file('image'));
            //$img = $img->resize(370, 246);
            $img->toWebp(80)->save(base_path('public/upload/' . $image_name));
            //$save_url = 'upload/product/' . $image_name;
            $product->image = $image_name;
        }
       
        $product->update();
        return redirect(route('products.details', compact('product')))->with('status','producto actualizado exitosamente.');
    }
    public function destroy(Product $product)
    {   
        $stock = Stock::where('product_id',$product->id)->first();
        $stock->delete();
        $product->delete();
        return redirect(route('brands.index'))->with('status', 'producto eliminado exitosamente.');
    }
}
