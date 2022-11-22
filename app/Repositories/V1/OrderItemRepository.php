<?php

namespace App\Repositories\V1;

use App\Models\OrderItems;
use App\Repositories\Base\BaseRepository;

class OrderItemRepository extends BaseRepository
{
    public function model()
    {
        return OrderItems::class;
    }
}
