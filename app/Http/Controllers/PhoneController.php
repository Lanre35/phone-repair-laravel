<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\PhoneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = PhoneModel::all();
        $brands = DB::table('phones')
            ->join('phone_models','phone_models.id','=','phones.model_id')
            ->select('phones.brand','phone_models.model_number')
            ->get();

        return view('phones.add-phone-name', compact('models','brands'));
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
        // dd('okk');
        $selectedModels = $request->input('model');
        $validation = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|exists:phone_models,id',
        ]);


        $save = Phone::create([
            'brand' => $request->brand,
            'model_id' => $request->model,
        ]);



        return redirect()->route('add-phone-name.index')->with('success', 'Phone added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
