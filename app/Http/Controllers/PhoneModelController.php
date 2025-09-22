<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\PhoneModel;
use Illuminate\Http\Request;

class PhoneModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = PhoneModel::all();
        return view('addModel.phone-model',compact('models'));
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
        $credentials = $request->validate([
            'model' => 'required',
            'model_number'=> 'required|alpha_dash'
        ]);

        PhoneModel::create($credentials);
        return redirect()->route('add-phone-model.index')->with('success','Data Save Successful');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
