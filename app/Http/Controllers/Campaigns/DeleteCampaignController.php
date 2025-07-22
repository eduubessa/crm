<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

final readonly class DeleteCampaignController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id)
    {
        //
        Campaign::findOrFail($id)->delete();
    }
}
