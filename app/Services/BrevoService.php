<?php

declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;

final readonly class BrevoService {

    private Client $http;

    public function __construct()
    {

        $this->http = new Client([
            'base_uri' => config('services.brevo.url'),
            'headers'  => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'api-key' => config('services.brevo.api_key'),
            ],
            'timeout' => config('services.brevo.tiemout')
        ]);
    }

    public function getAllCampaigns()
    {
        $response = $this->http->request('GET', config('services.brevo.base_url') . 'emailCampaigns');

        return json_decode($response->getBody()->getContents(), true)["campaigns"];
    }

}
