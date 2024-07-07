<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;
    protected $fillable = [
        'desc',
      
    ];
    public function product()
    {
        return $this->hasMany(Product::class, 'id');
    }
}
