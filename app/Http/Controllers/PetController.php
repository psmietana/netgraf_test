<?php

namespace App\Http\Controllers;

use App\Enums\Pet\Status;
use App\Services\PetStoreApi;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function __construct(
        protected PetStoreApi $petStoreApi,
    ) {}

    public function index()
    {
        return view('pet.index', [
            'podcast' => $this->petStoreApi->getAll()
        ]);
    }

    public function create()
    {
        return view('pet.create', [
            'statuses' => Status::cases(),
        ]);
    }

    public function store(Request $request)
    {
        $this->petStoreApi->post();

        return redirect()->route('pet.index');
    }

    public function edit(int $id)
    {
        return view('pet.edit', [
            'pet' => $this->petStoreApi->getById($id),
            'statuses' => Status::cases(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $this->petStoreApi->put($id);

        return redirect()->route('pet.index');
    }

    public function destroy(int $id)
    {
        $this->petStoreApi->delete($id);

        return redirect()->route('pet.index');
    }
}
