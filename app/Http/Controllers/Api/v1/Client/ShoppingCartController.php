<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Client\CartItemStoreRequest;
use App\Services\V1\ShoppingCartService;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    protected $shoppingCartService;

    public function __construct(ShoppingCartService $shoppingCartService)
    {
        $this->shoppingCartService = $shoppingCartService;
    }

    /**
     * @return void
     */
    public function show()
    {
        return $this->shoppingCartService->showProductInCart();
    }


    /**
     * Add product to cart | user login
     *
     * @param CartItemStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(CartItemStoreRequest $request)
    {
        return $this->shoppingCartService->addProductToCart($request->all());
    }

    /**
     * Delete product in cart | user login
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->shoppingCartService->deleteProductInCart($id);
    }

    /**
     * Update quantity product in cart | user login
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        return $this->shoppingCartService->updateProductInCart($id, $request->act ?? 'sum');
    }
}
