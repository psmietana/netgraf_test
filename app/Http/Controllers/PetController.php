<?php

namespace App\Http\Controllers;

use App\Enums\Pet\Status;
use App\Exceptions\Pet\PetApiException;
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
        try {
            $this->petStoreManager->post(new PetModel(
                $request->input('name'),
                $request->input('category'),
                $request->input('photoUrls'),
                $request->input('tags'),
                $request->input('status'),
            ));
        } catch (PetApiException $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->route('pet.index');
        }

        session()->flash('success', 'Pet added');
        return redirect()->route('pet.index');
    }

    public function edit(int $id)
    {
        try {
            $pet = $this->petStoreManager->getById($id);
        } catch (PetApiException $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->route('pet.index');
        }

        return view('pet.edit', [
            'pet' => $pet,
            'statuses' => Status::cases(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        try {
            $this->petStoreManager->put(new PetModel(
                $request->input('name'),
                $request->input('category'),
                $request->input('photoUrls'),
                $request->input('tags'),
                $request->input('status'),
            ));
        } catch (PetApiException $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->route('pet.index');
        }

        session()->flash('success', 'Pet updated');
        return redirect()->route('pet.index');
    }

    public function destroy(int $id)
    {
        try {
            $this->petStoreManager->delete($id);
        } catch (PetApiException $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->route('pet.index');
        }

        session()->flash('success', 'Pet updated');
        return redirect()->route('pet.index');
    }
}
