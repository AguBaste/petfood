<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id',
        'flavor_id',
        'race_id',
        'price',
        'weight',
        'image'
    ];
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id'); //lleva brand_id
    }
    public function flavor()
    {
        return $this->belongsTo(Flavor::class, 'flavor_id');
    }
    public function race()
    {
        return $this->belongsTo(Race::class, 'race_id');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class, 'id');
    }
    public function stock()
    {
        return $this->hasMany(Stock::class, 'id');
    }
    public function purchase()
    {
        return $this->haMany(Purchase::class, 'id');
    }
}
