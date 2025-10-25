<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\PriorityModel;
use App\Models\Repair;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $priorities = PriorityModel::simplePaginate(2);
        return view('settings.priority', compact('priorities'));
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
            'priority' => 'required'
        ]);

       $priority =  PriorityModel::create($validation);
       return redirect()->route('priority.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {
        $request->validate([
            'priority' => 'required|exists:priorities,id',
        ]);

        $repair = Repair::find($id);
        if (!$repair) {
            return redirect()->back()->with('error', 'Repair not found.');
        }

        $repair->priority_id = $request->input('priority');
        $periority = PriorityModel::find($repair->priority_id);
        $periority = $repair->priority_id;


        if ($repair->save()) {
            return redirect()->back()->with('success', 'Repair status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update repair status.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $priority = PriorityModel::find($id);
        if ($priority) {
            $priority->delete();
            return redirect()->back()->with('success', 'Priority deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Priority not found.');
        }
    }
}
