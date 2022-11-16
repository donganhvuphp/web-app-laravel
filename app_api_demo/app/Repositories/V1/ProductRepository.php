<?php

namespace App\Repositories\V1;

use App\Models\Product;
use App\Repositories\Base\BaseRepository;

class ProductRepository extends BaseRepository
{
    public function model(): string
    {
        return Product::class;
    }
}
