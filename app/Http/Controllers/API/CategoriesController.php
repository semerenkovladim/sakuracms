<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\DeleteCategoryRequest;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Carbon\Carbon;

class CategoriesController extends Controller
{
    public function index() {
        return CategoryResource::collection(Category::with(['category', 'products'])->paginate(15));
    }

    public function allWithoutPagination() {
        return CategoryResource::collection(Category::all());
    }

    public function one($id) {
        return new CategoryResource(Category::with(['category'])->find($id));
    }

    public function create(StoreCategoryRequest $request) {
        $validate = $request->validated();

        $category = new Category();
        $category->title = $request->title;
        if($request->category_id) {
            $parentCategory = Category::find($request->category_id);
            $category->category()->associate($parentCategory);
        }
        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();
        $category->save();
        return response()->json([], 200);
    }

    public function update($id, UpdateCategoryRequest $request) {
        $validate = $request->validated();

        $category = Category::find($id);
        $category->title = $request->title;
        $parentCategory = Category::find($request->category_id);
        $category->category()->dissociate();
        $category->category()->associate($parentCategory);
        $category->updated_at = Carbon::now();
        $category->save();

        return response()->json([], 200);
    }
    public function delete($id, DeleteCategoryRequest $request) {
        $validate = $request->validated();

        $category  = Category::find($id);
        $category->delete();
        return response()->json([], 200);
    }
}
