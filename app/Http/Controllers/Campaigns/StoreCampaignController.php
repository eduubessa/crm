<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignRequest;
use App\Models\Campaign;
use Illuminate\Http\Request;

final readonly class StoreCampaignController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreCampaignRequest $request)
    {
        //
        $validated = $request->validated();

        $campaign = Campaign::create($request->all());

        if(!$campaign){
            return back()->withInput($request->all())->withErrors([$validated]);
        }

        return redirect()->to('/campaigns')->with(['status' => "Campaign was successfully success!"]);
    }
}
