<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    public function index() {
        $languages = Language::all();

        return response()->json([
            $languages
        ], 200);
    }

    public function show($id) {
        $language = Language::find($id);

        return response()->json([
            $language
        ], 200);
    }

    public function create(Request $request) {
        $language = new Language();
        $language->title = $request->title;
        $language->iso = $request->iso;
        $language->created_at = Carbon::now();
        $language->updated_at = Carbon::now();
        $language->save();

        return response()->json([], 200);

    }

    public function update($id, Request $request) {
        $language = Language::find($id);
        $language->title = $request->title;
        $language->iso = $request->iso;
        $language->updated_at = Carbon::now();
        $language->save();

        return response()->json([], 200);
    }

    public function delete($id) {
        $language = Language::find($id);
        $language->delete();

        return response()->json([], 200);
    }
}
