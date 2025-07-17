<?php

declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;

final readonly class BrevoService {

    public function __construct(
        protected Client $http,
        protected string $apiToken
    )
    { }

    public static function create(): BrevoService
    {
        $client = new Client([
            'base_uri' => config('services.brevo.base_url'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'api-key' => config('services.brevo.api_key'),
            ],
        ]);

        return new self($client, config('services.brevo.api_token'));
    }

    public function sendEmail(array $data): array
    {
        $response = $this->http->post('smtp/email', [
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

}
