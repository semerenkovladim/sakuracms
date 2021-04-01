<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Newsletter\DeleteNewsletterRequest;
use App\Http\Requests\Newsletter\StoreNewsletterRequest;
use App\Http\Requests\Newsletter\UpdateNewsletterRequest;
use App\Http\Resources\NewsletterResource;
use App\Models\Newsletter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewslettersController extends Controller
{
    public function index() {
        return NewsletterResource::collection(Newsletter::paginate(15));
    }

    public function allWithoutPagination() {
        return NewsletterResource::collection(Newsletter::all());
    }

    public function create(StoreNewsletterRequest $request) {
        $validate = $request->validated();

        $newsletter = new Newsletter();
        $newsletter->title = $request->title;
        $newsletter->body = $request->body;
        $newsletter->sending_at = new Carbon($request->sending_at);
        $newsletter->created_at = Carbon::now();
        $newsletter->updated_at = Carbon::now();
        $newsletter->save();

        return response()->json([], 200);

    }

    public function delete($id, DeleteNewsletterRequest $request) {
        $validate = $request->validated();

        $newsletter = Newsletter::find($id);
        $newsletter->delete();

        return response()->json([], 200);
    }
}
