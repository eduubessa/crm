<?php

namespace App\Console\Commands\Campaigns;

use App\Dto\CampaignDto;
use App\Models\Campaign;
use App\Services\BrevoService;
use Illuminate\Console\Command;

class ImportCampaignCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaigns:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $campaignFromService = new BrevoService();

        $campaigns = array_map(function ($item) {

            return new CampaignDto(
                campaignId: $item['id'],
                name: $item['name'],
                replyTo: $item['replyTo'],
                subject: $item['subject'],
                previewText: $item['previewText'],
                htmlContent: $item['htmlContent'],
                status: $item['status'],
                type: $item['type'],
            );
        }, $campaignFromService->getAllCampaigns());

        foreach($campaigns as $campaign) {
            $this->updateOrCreateCampaign($campaign);
        }
    }

    private function updateOrCreateCampaign(CampaignDto $campaignDto): void
    {
        Campaign::updateOrCreate([
            'campaign_id' => (int) $campaignDto->campaignId
        ], [
            'name' => $campaignDto->name,
            'reply_to' => $campaignDto->replyTo,
            'subject' => $campaignDto->subject,
            'preview_text' => $campaignDto->previewText,
            'html_content' => $campaignDto->htmlContent,
            'type' => $campaignDto->type,
            'status' => $campaignDto->status,
        ]);
    }
}
