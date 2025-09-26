<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('settings.products');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.products');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('okk');

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_abbreviation' => 'required|string|max:10'
        ]);

        Product::create([
            'product' => $request->input('product_name'),
            'abbreviation' => $request->input('product_abbreviation')
        ]);

        return redirect()->route('products.create')->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
