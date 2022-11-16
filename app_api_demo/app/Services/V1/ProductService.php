<?php

namespace App\Services\V1;

use App\Repositories\V1\ProductRepository;
use App\Services\Base\BaseServices;
use Illuminate\Http\Response;

class ProductService extends BaseServices
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        try {
            $products = $this->productRepository->getAll();

            return $this->responseJson(
                $products,
                message: __('message.get.success', ['name' => 'products']),
                status: HTTP_STATUS['SUCCESS']
            );
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getProduct($id)
    {
        try {
            $product = $this->productRepository->findOrFail($id);
            return $this->responseJson(
                $product,
                message: __('message.get.success', ['name' => 'product']),
                status: HTTP_STATUS['SUCCESS']
            );
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createProduct(array $data)
    {
        try {
            $product = $this->productRepository->store($data);
            return $this->responseJson(
                $product,
                message: __('message.create.success', ['name' => 'product']),
                status: HTTP_STATUS['SUCCESS']
            );
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateProduct($id, array $data)
    {
        try {
            $product = $this->productRepository->update($id, $data);
            return $this->responseJson(
                $product,
                message: $product ? __('message.update.success', ['name' => 'product']) :
                    __('message.update.failed', ['name' => 'product']),
                status: $product ? HTTP_STATUS['SUCCESS'] : HTTP_STATUS['BAD_REQUEST']
            );
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteProduct($id)
    {
        try {
            $this->productRepository->deleteById($id);
            return $this->responseJson(
                message: __('message.delete.success', ['name' => 'product']),
                status: HTTP_STATUS['SUCCESS']
            );
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
