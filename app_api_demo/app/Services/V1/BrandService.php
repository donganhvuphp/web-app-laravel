<?php

namespace App\Services\V1;

use App\Repositories\V1\BrandRepository;
use App\Services\Base\BaseServices;
use App\Traits\HandleUploadFile;
use Exception;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\throwException;

class BrandService extends BaseServices
{
    use HandleUploadFile;

    protected BrandRepository $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAll(): Response|Application|ResponseFactory
    {
        $brands = $this->brandRepository->getAll();

        return $this->responseJson($brands, HTTP_STATUS['SUCCESS'], __('message.get.success', ['name' => 'brand']));
    }

    public function getById($id): Response|Application|ResponseFactory
    {
        $brands = $this->brandRepository->getById($id);

        return $this->responseJson($brands, HTTP_STATUS['SUCCESS'], __('message.get.success', ['name' => 'brand']));
    }

    /**
     * @throws Exception
     */
    public function createBrand($attributes): Response|Application|ResponseFactory
    {
        try {
            $attributes['image'] = Storage::disk('dropbox')->put('brands', $attributes['image']);
            $newBrand = $this->brandRepository->store($attributes);

            return $this->responseJson($newBrand, HTTP_STATUS['SUCCESS']);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function updateBrand($id, $attributes): Response|Application|ResponseFactory
    {
        try {
            if (!empty($attributes['image'])) {
                $current = $this->brandRepository->getById($id);
                $attributes['image'] = $this->handleUpload('brands', $attributes['image'], $current['image'] ?? null);
            }
            $newBrand = $this->brandRepository->update($id, $attributes);

            return $this->responseJson(
                $newBrand,
                HTTP_STATUS['SUCCESS'],
                __('message.update.success', ['name' => 'Brand'])
            );
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function deleteById($id): Response|Application|ResponseFactory
    {
        try {
            $current = $this->brandRepository->getById($id);
            if (!empty($current['image'])) {
                $this->deleteFile($current['image']);
            }
            $brand = $this->brandRepository->deleteById($id);

            return $this->responseJson(
                $brand,
                HTTP_STATUS['SUCCESS'],
                __('message.delete.success', ['name' => 'Brand'])
            );
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }
}
