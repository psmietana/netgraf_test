<?php

namespace App\Http\Request\Model;

use App\Enums\Pet\Status;

class PetModel
{
    private ?CategoryModel $category;
    private ?array $photoUrls;
    private array $tags;
    private ?Status $status;
    public function __construct(
        private readonly ?string $name,
        ?string $categoryName,
        ?string $photoUrls,
        ?string $tags,
        ?string $status,
    ) {
        $this->category = $categoryName ? new CategoryModel(0, $categoryName) : null;
        $this->photoUrls = $photoUrls ? explode(',', $photoUrls) : null;
        $this->tags = $this->convertTagsToModels($tags);
        $this->status = Status::tryFrom($status);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getCategory(): ?CategoryModel
    {
        return $this->category;
    }

    public function getPhotoUrls(): ?array
    {
        return $this->photoUrls;
    }

    /**
     * @return array<TagModel>
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    private function convertTagsToModels(?string $tags): array
    {
        $tags = $tags ? explode(',', $tags) : [];

        return array_map(
            static fn(string $tag) => new TagModel(0, $tag),
            $tags
        );
    }
}
