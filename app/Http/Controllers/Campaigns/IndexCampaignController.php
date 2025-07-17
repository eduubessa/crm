<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final readonly class IndexCampaignController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //

        return response()->json([
            "Hello world"
        ]);
    }
}
