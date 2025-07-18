<?php
declare(strict_types=1);

namespace App\Dto;

use Monolog\DateTimeImmutable;
use phpDocumentor\Reflection\Types\Integer;

readonly class CampaignDto
{
    public function __construct(
        public int $campaignId,
        public string $name,
        public ?string $replyTo = null,
        public string $subject,
        public string $previewText,
        public string $htmlContent,
        public string $type,
        public string $status,
    )
    {
    }
}
