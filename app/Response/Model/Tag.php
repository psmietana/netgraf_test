<?php

namespace App\Response\Model;

class Tag
{
    public function __construct(
        private readonly int $id,
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
