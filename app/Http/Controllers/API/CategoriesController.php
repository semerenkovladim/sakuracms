<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\DeleteCategoryRequest;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function all() {
        $categories = Category::with(['category', 'products'])->get();
        return response()->json([
            $categories
        ], 200);
    }

    public function one($id) {
        $categories = Category::with(['category'])->get();
        $category = $categories->find($id);
        return response()->json([
            $category
        ], 200);
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
