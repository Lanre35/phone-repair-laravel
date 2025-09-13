<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Repair;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'status' => 'required|string|max:255',
        ]);

        Status::create([
            'name' => $request->input('status'),
        ]);

        return redirect()->route('add-phone-name.index')->with('success', 'Status added successfully.');
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

        $request->validate([
            'status' => 'required|exists:statuses,id',
        ]);

        $repair = Repair::find($id);
        if (!$repair) {
            return redirect()->back()->with('error', 'Repair ticket not found.');
        }

        // dd($request->input('status'));
        //pry_key status
        $repair->status_id = $request->input('status');

        //Set completion_date if status is not "Pending"
        $pendingStatus = Status::where('name', $repair->status_id)->value('id');
        $pendingStatus = $repair->status_id;

        // $repair->completion_date = $request->input('status') != $pendingStatus ? now() : null;

        if ($repair->save()) {
            return redirect()->back()->with('success', 'Repair status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update repair status.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
