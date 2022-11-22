<?php

namespace App\Repositories\V1;

use App\Models\OrderDetails;
use App\Repositories\Base\BaseRepository;

class OrderDetailRepository extends BaseRepository
{
    public function model()
    {
        return OrderDetails::class;
    }
}
