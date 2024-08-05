<?php

namespace App\Services;

use App\Enums\Pet\Status;
use App\Exceptions\Pet\PetApiException;
use App\Http\Request\Model\PetModel;
use App\Response\Model\Category;
use App\Response\Model\Pet;
use App\Response\Model\Tag;
use Dropelikeit\LaravelJmsSerializer\Http\Responses\ResponseFactory;
use Illuminate\Support\Facades\Http;

class PetStoreApiManager implements PetStoreManagerInterface
{
    private const API_URL_PREFIX = 'pet';

    private string $url;

    public function __construct(
        private readonly ResponseFactory $serializedResponseFactory,
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
        if ($response->failed()) {
            throw new PetApiException('Something went wrong');
        }

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
        if ($response->failed()) {
            throw new PetApiException('Something went wrong');
        }

        return $this->mapArrayToPetModel(
            json_decode($response->body(), true)
        );
    }

    public function post(PetModel $petModel): void
    {
        $serialized = $this->serializedResponseFactory->create($petModel);
        $response = Http::post(
            $this->url,
            json_decode($serialized->getContent(), true),
        );
        if ($response->failed()) {
            throw new PetApiException('Something went wrong');
        }
    }

    public function put(PetModel $petModel): void
    {
        $serialized = $this->serializedResponseFactory->create($petModel);
        $response = Http::put(
            $this->url,
            json_decode($serialized->getContent(), true),
        );
        if ($response->failed()) {
            throw new PetApiException('Something went wrong');
        }
    }

    public function delete(int $id): void
    {
        $response = Http::withHeaders([
            'api_key' => $this->apiKey,
        ])->delete(
            sprintf('%s/%s', $this->url, $id)
        );
        if ($response->failed()) {
            throw new PetApiException('Something went wrong');
        }
    }

    public function mapArrayToPetModel(array $input): Pet
    {
        $category = isset($input['category'], $input['category']['id'], $input['category']['name'])
            ? new Category($input['category']['id'], $input['category']['name'])
            : null;

        $tags = [];
        if (isset($input['tags'])) {
            foreach ($input['tags'] as $tag) {
                $tags[] = isset($tag['id'], $tag['name'])
                    ? new Tag($tag['id'], $tag['name'])
                    : null;
            }
        }

        return new Pet(
            $input['id'],
            $category ?? null,
            $input['name'],
            $input['photoUrls'] ?? '',
            $tags ? array_filter($tags) : null,
            Status::from($input['status']),
        );
    }
}
