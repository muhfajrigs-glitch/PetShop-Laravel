<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    // Browse
    public function index()
    {
        $query = Customer::withCount('pets')->orderBy('name');

        // Search & Filter
        if ($search = request('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        }

        $customers = $query->paginate(10);

        return view('customers.index', compact('customers'));
    }

    // Add (form)
    public function create()
    {
        return view('customers.create');
    }

    // Add (store)
    public function store(StoreCustomerRequest $request)
    {
        Customer::create($request->validated());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil ditambahkan.');
    }

    // Read
    public function show(Customer $customer)
    {
        $customer->load('pets');
        return view('customers.show', compact('customer'));
    }

    // Edit (form)
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    // Edit (update)
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil diperbarui.');
    }

    // Delete
    public function destroy(Customer $customer)
    {
        // Count related pets sebelum delete
        $pets_count = $customer->pets()->count();
        $customer->delete();

        $message = $pets_count > 0 
            ? "Customer dan {$pets_count} pets berhasil dihapus." 
            : 'Customer berhasil dihapus.';

        return redirect()
            ->route('customers.index')
            ->with('success', $message);
    }
}