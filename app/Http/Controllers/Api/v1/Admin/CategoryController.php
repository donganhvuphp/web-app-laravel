<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\CategoryRequest;
use App\Http\Resources\V1\Admin\CategoryResource;
use App\Models\CategoryProduct;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use function PHPUnit\Framework\throwException;

class CategoryController extends Controller
{
    protected $categoryProduct;

    public function __construct(CategoryProduct $categoryProduct)
    {
        $this->categoryProduct = $categoryProduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryProduct->all();
        $categoryResource = CategoryResource::collection($categories);
        return $this->sentSuccessfully(
            $categoryResource,
            message: __('message.get.success', ['name' => 'categories']),
            status: HTTP_STATUS['SUCCESS']
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Http\Requests\V1\Admin\CategoryRequest  $categoryRequest
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $categoryRequest)
    {
        $category = $this->categoryProduct->create($categoryRequest->all());
        $categoryResource = new CategoryResource($category);
        return $this->sentSuccessfully(
            $categoryResource,
            message: __('message.create.success', ['name' => 'category']),
            status: HTTP_STATUS['SUCCESS']
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryProduct->findOrFail($id);
        $categoryResource = new CategoryResource($category);
        return $this->sentSuccessfully(
            $categoryResource,
            message: __('message.get.success', ['name' => 'category']),
            status: HTTP_STATUS['SUCCESS']
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = $this->categoryProduct->findOrFail($id);
        $category->update($request->all());
        $categoryResource = new CategoryResource($category);
        return $this->sentSuccessfully(
            $categoryResource,
            message: __('message.update.success', ['name' => 'category']),
            status: HTTP_STATUS['SUCCESS']
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryProduct->findOrFail($id);
        $category->delete();
        return $this->sentSuccessfully(
            message: __('message.delete.success', ['name' => 'category']),
            status: HTTP_STATUS['SUCCESS']
        );
    }
}
