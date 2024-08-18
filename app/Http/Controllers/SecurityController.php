<?php

namespace App\Http\Controllers;

use App\Models\Security;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Race;
use App\Models\Flavor;
use Illuminate\Support\Facades\Storage;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::All();
        $brands = Brand::All();
        $races = Race::All();
        $flavors = Flavor::All();
        $contenido = "Productos:\n";
        foreach ($products as $product) {
            $contenido .= "ID: {$product->id}, Marca: {$product->brand_id}, Raza: {$product->race_id}, Sabor: {$product->flavor_id}, Precio: {$product->price}, Peso: {$product->weight}, Imagen: {$product->image}\n";
        }

        $contenido .= "\nMarcas:\n";
        foreach ($brands as $brand) {
        $contenido.="id:{$brand->id}, desc: {$brand->desc}\n";
        }
        $contenido .= "\nRazas:\n";
        foreach ($races as $race) {
        $contenido.="id:{$race->id}, desc: {$race->desc}\n";
        }
        $contenido .= "\nSabores:\n";
        foreach ($flavors as $flavor) {
        $contenido.="id:{$flavor->id}, desc: {$flavor->desc}\n";
        }
        // Repite lo mismo para las otras tablas (Razas y Sabores)

        $nombreArchivo = 'backup.txt'; // Nombre del archivo
        Storage::put($nombreArchivo, $contenido);

        return redirect(route('dashboard'))->with('status','copia de seguridad realizada exitosamente');
    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Security $security)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Security $security)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Security $security)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Security $security)
    {
        //
    }
}
