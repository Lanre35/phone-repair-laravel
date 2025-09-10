<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Repair;
use App\Models\Status;
use App\Enums\Priority;
use App\Models\Customer;
use App\Models\PhoneModel;
use Illuminate\Http\Request;
use App\Models\PriorityModel;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::where('id', '!=', null)->get();
        $brands = Phone::all();
        $models = PhoneModel::all();
        $priorities = PriorityModel::all();
        $statuses = Status::all();
        $repairs = Repair::with(['customer', 'phone'])->get();
        // dd();
        return view('Repairs.index', compact('customers','brands','models', 'priorities', 'statuses', 'repairs'));
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
        $request->validate([
            'name' => 'required|exists:customers,id',
            'phone_number' => 'required|string|max:15',
            'device_brand' => 'required|exists:phones,id',
            'device_model' => 'required|exists:phone_models,id',
            'issue' => 'required|string|max:255',
            'priority' => 'required|exists:priorities,id',
            'status' => 'required|exists:statuses,id',
        ]);

        $save = Repair::query()->create([
           'customer_id' => $request->input('name'),
           'phone_number' => $request->input('phone_number'),
           'device_brand_id' => $request->input('device_brand'),
           'device_model_id' => $request->input('device_model'),
           'priority_id' => $request->input('priority'),
           'status_id' => $request->input('status'),
           'issue_description' => $request->input('issue'),
        ]);
        if($save){
            return redirect()->back()->with('success', 'Repair ticket created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create repair ticket.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
