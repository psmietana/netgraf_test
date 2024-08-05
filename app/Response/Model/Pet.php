<?php

namespace App\Response\Model;

use App\Enums\Pet\Status;

class Pet
{
    public function __construct(
        private int            $id,
        private ?Category $category,
        private string         $name,
        private array          $photoUrls,
        private ?array         $tags,
        private ?Status        $status,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @return array<string>
     */
    public function getPhotoUrls(): array
    {
        return $this->photoUrls;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    /**
     * @return ?array<Tag>
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
