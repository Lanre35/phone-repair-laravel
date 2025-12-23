<?php

declare(strict_types=1);


namespace App\Http\Controllers;

use App\Http\Requests\CustomerValRequest;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('repairs')->simplePaginate(2);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerValRequest $request)
    {
        if($request->user()->role === 'USER'){
            return redirect()->route('customers.index')->with('error','You are not authorized to create customers.');
        }

        Customer::create($request->validated());

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $customer->load('repairs');
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,Customer $customer)
    {
        if($request->user()->role === 'USER'){
            return redirect()->route('customers.index')->with('error','You are not authorized to edit customer.');
        }
        $customer->load('repairs');
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerValRequest $request, Customer $customer)
    {
        if($request->user()->role === 'USER'){
            return redirect()->route('customers.index')->with('error', 'You are not authorized to create customer.');
        }
        $customer->update($request->validated());
        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Customer $customer)
    {

        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
