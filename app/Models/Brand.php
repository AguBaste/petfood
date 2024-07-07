<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'desc',
      
    ];
    public function product()
    {
        $this->hasMany(Product::class,'id');// lleva 'id'
    }
}
