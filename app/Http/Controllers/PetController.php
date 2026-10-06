<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Customer;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;

class PetController extends Controller
{
    // Browse
    public function index()
    {
        $query = Pet::with('customer')->orderBy('name');

        // Search & Filter
        if ($search = request('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('species', 'like', "%{$search}%")
                  ->orWhereHas('customer', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        if ($customer = request('customer_id')) {
            $query->where('customer_id', $customer);
        }

        if ($species = request('species')) {
            $query->where('species', $species);
        }

        if ($gender = request('gender')) {
            $query->where('gender', $gender);
        }

        $pets = $query->paginate(10);
        $customers = Customer::orderBy('name')->get();
        
        // Get unique species & gender untuk filter
        $allSpecies = Pet::distinct()->pluck('species')->sort();
        $allGenders = ['male', 'female'];

        return view('pets.index', compact('pets', 'customers', 'allSpecies', 'allGenders'));
    }

    // Add (form)
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $customer_id = request('customer_id');
        return view('pets.create', compact('customers', 'customer_id'));
    }

    // Add (store)
    public function store(StorePetRequest $request)
    {
        Pet::create($request->validated());

        return redirect()
            ->route('pets.index')
            ->with('success', 'Pet berhasil ditambahkan.');
    }

    // Read
    public function show(Pet $pet)
    {
        $pet->load('customer');
        return view('pets.show', compact('pet'));
    }

    // Edit (form)
    public function edit(Pet $pet)
    {
        $customers = Customer::orderBy('name')->get();
        return view('pets.edit', compact('pet', 'customers'));
    }

    // Edit (update)
    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $pet->update($request->validated());

        return redirect()
            ->route('pets.index')
            ->with('success', 'Pet berhasil diperbarui.');
    }

    // Delete
    public function destroy(Pet $pet)
    {
        $pet->delete();

        return redirect()
            ->route('pets.index')
            ->with('success', 'Pet berhasil dihapus.');
    }
}