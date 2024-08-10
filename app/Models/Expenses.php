<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    public $fillable =[
        'desc',
        'price'
    ];

    use HasFactory;
}
