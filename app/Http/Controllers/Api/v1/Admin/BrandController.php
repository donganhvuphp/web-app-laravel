<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\BrandRequest;
use App\Services\V1\BrandService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    protected BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index(): Response|Application|ResponseFactory
    {
        return $this->brandService->getAll();
    }

    /**
     * @throws Exception
     */
    public function store(BrandRequest $request): Response
    {
        return $this->brandService->createBrand($request->all());
    }

    public function show($id): Response|Application|ResponseFactory
    {
        return $this->brandService->getById($id);
    }

    /**
     * @throws Exception
     */
    public function update(BrandRequest $request, $id): Response|Application|ResponseFactory
    {
        return $this->brandService->updateBrand($id, $request->all());
    }

    /**
     * @throws Exception
     */
    public function destroy($id): Response|Application|ResponseFactory
    {
        return $this->brandService->deleteById($id);
    }
}
