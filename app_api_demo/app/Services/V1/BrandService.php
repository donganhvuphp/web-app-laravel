<?php

namespace App\Services\V1;

use App\Repositories\V1\BrandRepository;
use App\Services\Base\BaseServices;

class BrandService extends BaseServices
{
    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAll()
    {
        $brands = $this->brandRepository->getAll();
        return $this->responseJson($brands, HTTP_STATUS['SUCCESS'], __('message.get.success', ['name' => 'brand']));
    }

    public function createBrand($data)
    {
        try {
            $newBrand = $this->brandRepository->store($data);
            return $this->responseJson($newBrand, HTTP_STATUS['SUCCESS']);
        } catch (\Exception $e) {
            return $this->responseJson(null, HTTP_STATUS['SUCCESS'], __('message.create.failed', ['name' => 'brand']));
        }
    }
}
