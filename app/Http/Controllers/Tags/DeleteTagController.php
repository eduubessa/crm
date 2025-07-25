<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class DeleteTagController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $slug)
    {
        //
        Tag::where('slug', $slug)->firstOrFail()->delete();

        return redirect()->to('tags')->with('success', 'Tag deleted successfully');
    }
}
