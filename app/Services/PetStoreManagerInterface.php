<?php

namespace App\Services;

interface PetStoreManagerInterface
{
    public function getAll();

    public function getById(int $id);

    public function post();

    public function put(int $id);

    public function delete(int $id);
}
