<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaigns\UpdateCampaignRequest;
use App\Models\Campaign;

class UpdateCampaignController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateCampaignRequest $request, string $id)
    {
        //
        $validated = $request->validated();

        $campaign = Campaign::findOrFail($id)->update($request->all());

        if(!$campaign) {
            return back()->withInput()->withErrors(['error' => 'Update campaign failed!']);
        }

        return redirect()->route('campaigns.list')->withInput()->withErrors(['success' => 'Update campaign successfully!']);
    }
}
