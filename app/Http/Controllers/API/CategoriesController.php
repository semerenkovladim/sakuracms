<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function all() {
        $categories = Category::all();
        return response()->json([
            $categories
        ], 200);
    }
}
