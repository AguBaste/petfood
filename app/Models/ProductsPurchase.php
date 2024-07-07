<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsPurchase extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function purchase()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
}
