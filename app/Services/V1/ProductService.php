<?php

namespace App\Services\V1;

use App\Repositories\V1\ProductRepository;
use App\Services\Base\BaseServices;
use App\Traits\HandleUploadFile;
use Illuminate\Http\Response;

class ProductService extends BaseServices
{
    use HandleUploadFile;

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

    public function createProduct(array $attributes)
    {
        $attributes['image'] = $this->handleUpload('products', $attributes['image'] ?? null);
        try {
            $product = $this->productRepository->store($attributes);

            return $this->responseJson(
                $product,
                message: __('message.create.success', ['name' => 'product']),
                status: HTTP_STATUS['SUCCESS']
            );
        } catch (\Throwable $e) {
            $this->deleteFile($attributes['image']);
            throw new \Exception($e->getMessage());
        }
    }

    public function updateProduct($id, array $attributes)
    {

        try {
            if (!empty($attributes['image'])) {
                $current = $this->productRepository->getById($id);
                $attributes['image'] = $this->handleUpload('products', $attributes['image'], $current['image'] ?? null);
            }

            $product = $this->productRepository->update($id, $attributes);

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
            $current = $this->productRepository->getById($id);
            if (!empty($current['image'])) {
                $this->deleteFile($current['image']);
            }
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
