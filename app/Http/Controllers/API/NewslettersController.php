<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewslettersController extends Controller
{
    public function index() {
        $newsletters = Newsletter::all();

        return response()->json([
            $newsletters
        ], 200);
    }

    public function show($id) {
        $newsletter = Newsletter::find($id);

        return response()->json([
            $newsletter
        ], 200);
    }

    public function create(Request $request) {
        $newsletter = new Newsletter();
        $newsletter->title = $request->title;
        $newsletter->body = $request->body;
        $newsletter->sending_at = new Carbon($request->sending_at);
        $newsletter->created_at = Carbon::now();
        $newsletter->updated_at = Carbon::now();
        $newsletter->save();

        return response()->json([], 200);

    }

    public function update($id, Request $request) {
        $newsletter = Newsletter::find($id);
        $newsletter->title = $request->title;
        $newsletter->body = $request->body;
        $newsletter->sending_at = new Carbon($request->sending_at);
        $newsletter->updated_at = Carbon::now();
        $newsletter->save();

        return response()->json([], 200);
    }

    public function delete($id) {
        $newsletter = Newsletter::find($id);
        $newsletter->delete();

        return response()->json([], 200);
    }
}
