<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'category_id',
        'brand_id',
        'price',
        'image',
        'description',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
