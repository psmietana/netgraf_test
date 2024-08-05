<?php

namespace App\Http\Controllers;

use App\Enums\Pet\Status;
use App\Http\Request\Model\PetModel;
use App\Services\PetStoreManagerInterface;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function __construct(
        protected PetStoreManagerInterface $petStoreManager,
    ) {}

    public function index()
    {
        return view('pet.index', [
            'pets' => $this->petStoreManager->getAll()
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
        $this->petStoreManager->post(new PetModel(
            $request->input('name'),
            $request->input('category'),
            $request->input('photoUrls'),
            $request->input('tags'),
            $request->input('status'),
        ));

        return redirect()->route('pet.index');
    }

    public function edit(int $id)
    {
        return view('pet.edit', [
            'pet' => $this->petStoreManager->getById($id),
            'statuses' => Status::cases(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $this->petStoreManager->put(new PetModel(
            $request->input('name'),
            $request->input('category'),
            $request->input('photoUrls'),
            $request->input('tags'),
            $request->input('status'),
        ));

        return redirect()->route('pet.index');
    }

    public function destroy(int $id)
    {
        $this->petStoreManager->delete($id);

        return redirect()->route('pet.index');
    }
}
