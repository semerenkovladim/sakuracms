<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\DeleteLanguageRequest;
use App\Http\Requests\Language\StoreLanguageRequest;
use App\Http\Requests\Language\UpdateLanguageRequest;
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

    public function create(StoreLanguageRequest $request) {
        $validate = $request->validated();

        $language = new Language();
        $language->title = $request->title;
        $language->iso = $request->iso;
        $language->created_at = Carbon::now();
        $language->updated_at = Carbon::now();
        $language->save();

        return response()->json([], 200);

    }

    public function update($id, UpdateLanguageRequest $request) {
        $validate = $request->validated();

        $language = Language::find($id);
        $language->title = $request->title;
        $language->iso = $request->iso;
        $language->updated_at = Carbon::now();
        $language->save();

        return response()->json([], 200);
    }

    public function delete($id, DeleteLanguageRequest $request) {
        $validate = $request->validated();

        $language = Language::find($id);
        $language->delete();

        return response()->json([], 200);
    }
}
