<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\InventoryValRequest;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('inventories')->get();
        $inventories = Inventory::with('product')->get();
        return view('Inventories.index', ['products' => $products, 'inventories' => $inventories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryValRequest $request)
    {
        Inventory::create($request->validated());
        return redirect()->back()->with('success', 'Inventory item added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        $products = Product::all();
        return view('Inventories.edit', compact('inventory', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InventoryValRequest $request, Inventory $inventory)
    {
        $validated = $request->validate($request->updateRules($inventory));
        $inventory->update($validated);
        if($inventory){
            return redirect()->route('inventories.index')->with('success', 'Inventory item updated successfully!');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory = Inventory::find($inventory->id);
        if (!$inventory) {
            return redirect()->back()->with('error', 'Inventory item not found!');
        }
        $inventory->delete();
        return redirect()->back()->with('success', 'Inventory item deleted successfully!');
    }
}
