<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::latest('id')->paginate(10);
        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        try {
            $model = Category::create(request()->all());
            return response()->json(['msg' => 'Thêm thành công']);
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'err' => $th->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try {
            $data = Category::findOrFail($category->id);
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'err' => $th->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category)
    {
        $model = Category::findOrFail($category->id);
        $model->update(request()->all());
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $data = Category::destroy($category->id);
            return response()->json(['data' => $data, 'msg' => 'Xóa thành công']);
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'err' => $th->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
