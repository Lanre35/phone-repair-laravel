<?php

namespace App\Http\Controllers;

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
        $products = Product::all();
        $inventories = Inventory::all();
        return view('Inventories.index',['products'=>$products, 'inventories'=>$inventories]);
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
    public function store(Request $request)
    {
        $validation = $request->validate([
            'part_name' => 'required|string|max:255',
            'skuId' => 'required|string|max:100|unique:inventories,skuId',
            'categoryId' => 'required|nullable|string|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'min_stock' => 'nullable|integer|min:0',
            'description' => 'nullable|string'
        ]);

        Inventory::create($validation);
        return redirect()->back()->with('success', 'Inventory item added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {

    }

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
    public function update(Request $request, Inventory $inventory)
    {
        $validation = $request->validate([
            'part_name' => 'required|string|max:255',
            'skuId' => 'required|string|max:100|unique:inventories,skuId,'.$inventory->id,
            'categoryId' => 'required|nullable|string|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'min_stock' => 'nullable|integer|min:0',
            'description' => 'nullable|string'
        ]);

        $inventory->update($validation);
        return redirect()->route('inventories.index')->with('success', 'Inventory item updated successfully!');
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
