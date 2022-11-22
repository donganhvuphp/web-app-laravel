<?php

namespace App\Services\V1;

use App\Repositories\V1\CartItemRepository;
use App\Repositories\V1\ShoppingSessionRepository;
use App\Services\Base\BaseServices;
use mysql_xdevapi\Exception;

class ShoppingCartService extends BaseServices
{
    protected $shoppingSessionRepository;
    protected $cartItemRepository;

    public function __construct(
        ShoppingSessionRepository $shoppingSessionRepository,
        CartItemRepository $cartItemRepository
    ){
        $this->shoppingSessionRepository = $shoppingSessionRepository;
        $this->cartItemRepository = $cartItemRepository;
    }

    /**
     * Add product to cart => update total shopping_session table
     *
     * @param array $attributes
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addProductToCart(array $attributes)
    {
        try {
            $cartItemBySessionId = $this->cartItemRepository->getCartItemByProductIdAndSessionId(shopping_session(), $attributes);
            $attributes['session_id'] = shopping_session();

            if (!empty($cartItemBySessionId->count())) {
                $cartItem = $this->cartItemRepository->update($cartItemBySessionId->first()->id, ['quantity' => $cartItemBySessionId->first()->quantity + 1]);
            } else {
                $cartItem = $this->cartItemRepository->store($attributes);
                !$cartItem ?: $this->shoppingSessionRepository->update(shopping_session(), attributes: ['total' => shopping_session('total') + 1]);
            }

            return $this->responseJson(
                $cartItem,
                message: __('message.create.success', ['name' => 'cart_item']),
                status: HTTP_STATUS['SUCCESS']
            );
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Delete product in cart => update total shopping_session table
     *
     * @param $productId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteProductInCart($productId)
    {
        try {
            $deleteProduct = $this->cartItemRepository->deleteProductInCart(shopping_session(), $productId);
            !$deleteProduct ?: $this->shoppingSessionRepository->update(shopping_session(), attributes: ['total' => shopping_session('total') - 1]);

            return $this->responseJson(
                message: $deleteProduct ? __('message.delete.success', ['name' => 'cart_item']) : __('message.delete.failed', ['name' => 'cart_item']),
                status: $deleteProduct ? HTTP_STATUS['SUCCESS'] : HTTP_STATUS['BAD_REQUEST']
            );
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updateProductInCart($productId, $act)
    {

        try {
            $cartItemBySessionId = $this->cartItemRepository->getCartItemByProductIdAndSessionId(shopping_session(), $productId);
            logger('longan' . $cartItemBySessionId);
            $quantity = $cartItemBySessionId->first()->quantity;
            $product = $this->cartItemRepository->update($cartItemBySessionId->first()->id,
                [
                    'quantity' => $act == 'sum' ? $quantity + 1 : ($quantity > 1 ? $quantity - 1 : 1)
                ]
            );

            return $this->responseJson(
                !$cartItemBySessionId ?: $product,
                message: __('message.update.success', ['name' => 'cart_item']),
                status: HTTP_STATUS['SUCCESS']
            );
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }
}
