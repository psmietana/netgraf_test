<?php

namespace App\Services;

use App\Enums\Pet\Status;
use Illuminate\Support\Facades\Http;

class PetStoreApi
{
    private const API_URL_PREFIX = 'pet';

    private string $url;

    public function __construct(
        private readonly string $apiUrl,
        private readonly string $apiKey,
    ) {
        $this->url = $this->apiUrl . '/' . self::API_URL_PREFIX;
    }

    public function getAll()
    {
        $statusesString = '';
        $statuses = Status::cases();
        $lastStatus = end($statuses);
        foreach ($statuses as $status) {
            $statusesString .= 'status=' . $status->value;
            if ($status !== $lastStatus) {
                $statusesString .= '&';
            }
        }
        $response = Http::get(
            sprintf(
                '%s/%s?%s',
                $this->url,
                'findByStatus',
                $statusesString,
            )
        );
    }

    public function getById(int $id)
    {
        $response = Http::get(
            sprintf(
                '%s/%s',
                $this->url,
                $id,
            )
        );
    }

    public function post()
    {
        $response = Http::post(
            $this->url,
        );
    }

    public function put(int $id)
    {
        $response = Http::put(
            $this->url,
        );
    }

    public function delete(int $id)
    {
        $response = Http::delete(
            $this->url,
            ['petId' => $id, 'api_key' => $this->apiKey],
        );
    }
}
