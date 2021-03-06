<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\File;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function str_slug;

class ProductsController extends Controller
{
    public function index() {
        return ProductResource::collection(Product::with(['category', 'images'])->paginate(15));
    }

    public function allWithoutPagination() {
        return ProductResource::collection(Product::all());
    }

    public function delete($id) {
        $product = Product::find($id);
        $product->delete();
        return response()->json([], 200);
    }

    public function create(StoreProductRequest $request) {
        $validate = $request->validated();

        $product = new Product();
        $category = Category::find($request->category_id);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->meta_tags = $request->meta_tags;
        $product->meta_description = $request->meta_description;
        $product->meta_title = $request->meta_title;
        $product->slug = str_slug($request->title . ' ' . Carbon::now()->toDateTimeString());
        $product->created_at = Carbon::now();
        $product->updated_at = Carbon::now();
        $product->category()->associate($category);
        $product->save();
        foreach($request->file('images') as $index => $file){
            $pathfile = str_replace(' ', '', str_slug($product->title)) . '-' . $index;
            $filename = $pathfile . '.' . $file->extension();
            $image = new File();
            $file->storeAs('/public/image/products/' . $pathfile, $filename);
            $image->path = '/image/products/' . $pathfile . '/' . $filename;
            $image->save();
            $product->images()->attach($image->id);
        }
        return response()->json([
            $product->images()
        ], 200);
    }

    public function show($id) {
        return new ProductResource(Product::with(['category', 'images'])->find($id));
    }

    public function update($id, UpdateProductRequest $request) {
        $validate = $request->validated();

        $product = Product::find($id);
        $category = Category::find($request->category_id);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->meta_tags = $request->meta_tags;
        $product->meta_description = $request->meta_description;
        $product->meta_title = $request->meta_title;
        $product->slug = str_slug($request->title . ' ' . Carbon::now()->toDateTimeString());
        $product->created_at = Carbon::now();
        $product->updated_at = Carbon::now();
        $product->category()->dissociate();
        $product->category()->associate($category);
        $product->images()->detach();
        $product->save();
        foreach($request->file('images') as $index => $file){
            $pathfile = str_replace(' ', '', str_slug($product->title)) . '-' . $index;
            $filename = $pathfile . '.' . $file->extension();
            $image = new File();
            $file->storeAs('/public/image/products/' . $pathfile, $filename);
            $image->path = '/image/products/' . $pathfile . '/' . $filename;
            $image->save();
            $product->images()->attach($image->id);
        }
        return response()->json([], 200);
    }
}
