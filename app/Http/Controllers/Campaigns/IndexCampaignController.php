<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Services\BrevoService;
use Illuminate\Http\Request;

final readonly class IndexCampaignController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $campaigns = Campaign::all();
        return response()->json($campaigns, 200);
    }
}
