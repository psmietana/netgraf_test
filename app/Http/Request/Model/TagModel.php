<?php

namespace App\Http\Request\Model;

use JMS\Serializer\Annotation as Serializer;

class TagModel
{
    public function __construct(
        /** @Serializer\Type('int') */
        private readonly int $id,
        /** @Serializer\Type('string') */
        private readonly string $name,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
