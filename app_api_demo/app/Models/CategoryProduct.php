<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $table = 'category_product';

    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
