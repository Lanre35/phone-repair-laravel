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
        $brands = Phone::simplePaginate(3);
        return view('phones.add-phone-name',compact('brands'));
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
            // 'model' => 'required|exists:phone_models,id',
        ]);


        $save = Phone::create([
            'brand' => $request->brand,
            // 'model_id' => $request->model,
        ]);



        return redirect()->route('add-phone-name.index')->with('success', 'Phone added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $show = Phone::findOrFail($id);
        $model = PhoneModel::findOrFail($id);
        return view('phones.show-phone', compact('show','model'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $edit = Phone::findOrFail($id);
        return view('phones.phone-edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validation = $request->validate([
            'brand' => 'required|string|max:255',
        ]);

        $update = Phone::findOrFail($id);
        // dd('okk');
        $update->update($validation);

        return redirect('phones')->with('success','Updated successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $delete = Phone::findOrFail($id);
        $delete->delete();
        return redirect()->back()->with('success', 'Phone deleted successfully.');
    }
}
