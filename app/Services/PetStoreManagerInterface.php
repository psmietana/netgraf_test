<?php

namespace App\Services;

use App\Http\Request\Model\PetModel;
use App\Response\Model\Pet;

interface PetStoreManagerInterface
{
    public function getAll(): array;

    public function getById(int $id): Pet;

    public function post(PetModel $petModel): void;

    public function put(PetModel $petModel): void;

    public function delete(int $id): void;
}
