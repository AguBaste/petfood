<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Configuration;
use App\Models\Flavor;
use App\Models\Payment;
use App\Models\Provider;
use App\Models\Race;
use App\Models\User; 


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Agustín Basterrica',
            'email' => 'agustinbasterrica@hotmail.com',
            'password'=>'sprinter413'
        ]);
        // medios de pago
        Payment::factory()->create([
            'desc' => 'Efectivo',
        ]);
        Payment::factory()->create([
            'desc'=>'Mercado Pago' 
        ]);
        // configuraciones
        Configuration::factory()->create([  
            'open' => 1.30,
            'close'=>1.20,
            'expenses'=>50,
        ]);

        // proveedores
        Provider::factory()->create([
            'name'=>'diego',
            'phone'=>2665117304
        ]);

        // marcas
        Brand::factory()->create([  
            'desc'=>'zimpi'
        ]);
        Brand::factory()->create([  
            'desc'=>'voras'
        ]);
        Brand::factory()->create([
            'desc'=>'maintenance'
        ]);
        Brand::factory()->create([
            'desc'=>'kongo gold'
        ]);
        Brand::factory()->create([
            'desc'=>'gati'
        ]);
        Brand::factory()->create([
            'desc'=>'7 vidas'
        ]);
        Brand::factory()->create([
            'desc'=>'cat chow'
        ]);
        Brand::factory()->create([
            'desc'=>'whiskas'
        ]);
        Brand::factory()->create([  
            'desc'=>'pedigree'
        ]);
        Brand::factory()->create([  
            'desc'=>'old prince'
        ]);
        Brand::factory()->create([  
            'desc'=>'royal canin'
        ]);
        Brand::factory()->create([  
            'desc'=>'agility'
        ]);
        Brand::factory()->create([  
            'desc'=>'dog chow'
        ]);
         Brand::factory()->create([  
            'desc'=>'sabrositos'
        ]);
        Brand::factory()->create([  
            'desc'=>'pupy'
        ]);
        Brand::factory()->create([  
            'desc'=>'biomax'
        ]);
        Brand::factory()->create([  
            'desc'=>'performance'
        ]);
        Brand::factory()->create([  
            'desc'=>'eukanuba'
        ]);
        Brand::factory()->create([  
            'desc'=>'arroz saborizado'
        ]);
        Brand::factory()->create([  
            'desc'=>'excellent'
        ]);
        Brand::factory()->create([  
            'desc'=>'balancear'
        ]);
        Brand::factory()->create([  
            'desc'=>'gandum'
        ]);
        Brand::factory()->create([  
            'desc'=>'ganacan'
        ]);
        Brand::factory()->create([  
            'desc'=>'sieguer'
        ]);
        Brand::factory()->create([  
            'desc'=>'crianza'
        ]);
        Brand::factory()->create([  
            'desc'=>'raza'
        ]);
        Brand::factory()->create([  
            'desc'=>'pro plan'
        ]);


        // razas
        Race::factory()->create([
            'desc'=>'perro adulto mediano/grande'
        ]);
        Race::factory()->create([
            'desc'=>'perro cachorro'
        ]);
        Race::factory()->create([
            'desc'=>'perro adulto mordida pequeña '
        ]);
        Race::factory()->create([
            'desc'=>'gato adulto'
        ]);
        Race::factory()->create([
            'desc'=>'gato castrado'
        ]);
        Race::factory()->create([
            'desc'=>'gatito'
        ]);
        Race::factory()->create([
            'desc'=>'mini adulto'
        ]);
        // sabores
        Flavor::factory()->create([
            'desc'=>'carne'
        ]);

        Flavor::factory()->create([
            'desc'=>'pollo'
        ]);
        Flavor::factory()->create([
            'desc'=>'carne y pollo'
        ]);
        Flavor::factory()->create([
            'desc'=>'salmon'
        ]);
        Flavor::factory()->create([
            'desc'=>'vegetales'
        ]);
        Flavor::factory()->create([
            'desc'=>'mix de carnes'
        ]);
        Flavor::factory()->create([
            'desc'=>'pescado'
        ]);
        Flavor::factory()->create([
            'desc'=>'mix de vegetales'
        ]);
        Flavor::factory()->create([
            'desc'=>'cordero'
        ]);

    }
}
