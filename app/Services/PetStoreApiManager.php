<?php

namespace App\Services;

use App\Enums\Pet\Status;
use App\Response\Model\Category;
use App\Response\Model\Pet;
use App\Response\Model\Tag;
use Illuminate\Support\Facades\Http;

class PetStoreApiManager implements PetStoreManagerInterface
{
    private const API_URL_PREFIX = 'pet';

    private string $url;

    public function __construct(
        private readonly string $apiUrl,
        private readonly string $apiKey,
    ) {
        $this->url = $this->apiUrl . '/' . self::API_URL_PREFIX;
    }

    public function getAll(): array
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

        return array_map(
            [PetStoreApiManager::class, 'mapArrayToPetModel'],
            json_decode($response->body(), true)
        );
    }

    public function getById(int $id): Pet
    {
        $response = Http::get(
            sprintf(
                '%s/%s',
                $this->url,
                $id,
            )
        );

        return $this->mapArrayToPetModel(
            json_decode($response->body(), true)
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
        $response = Http::withHeaders([
            'api_key' => $this->apiKey,
        ])->delete(
            sprintf('%s/%s', $this->url, $id)
        );
    }

    public function mapArrayToPetModel(array $input): Pet
    {
        $category = isset($input['category'])
            ? new Category($input['category']['id'], $input['category']['name'])
            : null;
        if (isset($input['tags'])) {
            $tags = [];
            foreach ($input['tags'] as $tag) {
                $tags[] = new Tag($tag['id'], $tag['name']);
            }
        }

        return new Pet(
            $input['id'],
            $category ?? null,
            $input['photoUrls'] ?? '',
            $tags ?? null,
            Status::from($input['status']),
        );
    }
}
