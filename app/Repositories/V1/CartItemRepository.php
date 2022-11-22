<?php

namespace App\Repositories\V1;

use App\Models\CartItem;
use App\Repositories\Base\BaseRepository;

class CartItemRepository extends BaseRepository
{
    public function model()
    {
        return CartItem::class;
    }

    public function getCartItemByProductIdAndSessionId($sessionId, $productId)
    {
        return $this->model->where('session_id', $sessionId)
            ->where('product_id', $productId)
            ->get();
    }

    public function deleteProductInCart($sessionId, $productId)
    {
        return $this->model->where('session_id', $sessionId)
            ->where('product_id', $productId)
            ->delete();
    }
}
