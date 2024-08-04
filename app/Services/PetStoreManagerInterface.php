<?php

namespace App\Services;

use App\Response\Model\Pet;

interface PetStoreManagerInterface
{
    public function getAll(): array;

    public function getById(int $id): Pet;

    public function post();

    public function put(int $id);

    public function delete(int $id);
}
