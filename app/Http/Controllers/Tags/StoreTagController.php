<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\StoreTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreTagController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreTagRequest $request)
    {
        //
        $request->validated();

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);

        if(!$tag->save()) {
            return redirect()->back()->with('error', 'Failed to create tag.');
        }

        return redirect()->to('/tags')->with('success', 'Tag created successfully.');
    }
}
