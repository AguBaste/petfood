<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'proveedor'
      
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
