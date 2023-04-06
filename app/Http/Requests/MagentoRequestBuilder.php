<?php

namespace App\Http\Requests;

use Illuminate\Http\Client\Factory as Client;
use Illuminate\Http\Client\PendingRequest;
use JustBetter\MagentoClient\Contracts\BuildsRequest;

class MagentoRequestBuilder implements BuildsRequest
{
    public function build(): PendingRequest
    {
        $client = new Client;

        $pendingRequest = $client->baseUrl(env('MAGENTO_BASE_URL'))
            ->withToken(env('MAGENTO_ACCESS_TOKEN'))
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->timeout(30)
            ->connectTimeout(10);

        return $pendingRequest;
    }
}