<?php

namespace App\Repositories\V1;

use App\Models\Brand;
use App\Repositories\Base\BaseRepository;

class BrandRepository extends BaseRepository
{
    public function model(): string
    {
        return Brand::class;
    }
}
