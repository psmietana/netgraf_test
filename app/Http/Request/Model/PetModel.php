<?php

namespace App\Http\Request\Model;

use App\Enums\Pet\Status;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class PetModel
{
    /**
     * @Serializer\Type(CategoryModel::class)
     **/
    private ?CategoryModel $category;

    /**
     * @Serializer\Type(array<string>)
     **/
    private ?array $photoUrls;

    /**
     * @Serializer\Type(array<TagModel::class>)
     **/
    private array $tags;

    /**
     * @Serializer\Type('string')
     * @Serializer\Accessor(getter="getStatus"))
     **/
    private ?Status $status;
    public function __construct(
        /** @Serializer\Type('int') */
        private readonly int     $id,
        /** @Serializer\Type('string') */
        private readonly ?string $name,
        ?string                  $categoryName,
        ?string                  $photoUrls,
        ?string                  $tags,
        ?string                  $status,
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

    public function getStatus(): ?string
    {
        return $this->status?->value;
    }

    public function getId(): int
    {
        return $this->id;
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
