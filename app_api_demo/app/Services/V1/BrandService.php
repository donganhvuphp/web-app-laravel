<?php

namespace App\Services\V1;

use App\Repositories\V1\BrandRepository;
use App\Services\Base\BaseServices;

use Exception;

use function PHPUnit\Framework\throwException;

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

    /**
     * @throws Exception
     */
    public function createBrand($data)
    {
        try {
            $newBrand = $this->brandRepository->store($data);
            return $this->responseJson($newBrand, HTTP_STATUS['SUCCESS']);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }
}
