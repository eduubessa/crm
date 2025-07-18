<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    /** @use HasFactory<\Database\Factories\CampaignFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'campaign_id', 'name', 'reply_to', 'subject', 'preview_text', 'html_content', 'type', 'status'
    ];
}
