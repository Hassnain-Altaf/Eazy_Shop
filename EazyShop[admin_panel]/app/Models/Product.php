<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'productname',
        'productdescription',
        'stockquantity',
        'totalprice',
        'discount',
        'category',
        'size',
        'tags',
        'image',
    ];
}
