<?php

namespace App\Repositories\V1;

use App\Models\ShoppingSession;
use App\Repositories\Base\BaseRepository;

class ShoppingSessionRepository extends BaseRepository
{
    public function model()
    {
        return ShoppingSession::class;
    }
}
