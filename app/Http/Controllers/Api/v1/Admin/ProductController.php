<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\ProductRequest;
use App\Http\Requests\V1\Admin\ProductStoreRequest;
use App\Services\V1\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->productService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\V1\Admin\ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        return $this->productService->createProduct($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->productService->getProduct($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\V1\Admin\ProductRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        return $this->productService->updateProduct($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->productService->deleteProduct($id);
    }
}
