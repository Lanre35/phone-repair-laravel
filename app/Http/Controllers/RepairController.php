<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Repair;
use App\Models\Status;
use App\Models\Customer;
use App\Models\PhoneModel;
use Illuminate\Http\Request;
use App\Models\PriorityModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\SoftDeletes;


class RepairController extends Controller
{
    use SoftDeletes;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('repairs')->get();
        $models = PhoneModel::with('phone')->get();
        $priorities = PriorityModel::with('repairs')->get();
        $statuses = Status::with('repairs')->get();
        $repairs = Repair::with(['customer', 'model', 'status', 'priority'])->simplePaginate(5);



        return view('Repairs.index', compact('customers', 'models', 'priorities', 'statuses', 'repairs'));
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
        $role = Auth::user()->role;
        if($role === "USER"){
            return redirect()->route('repairs.index')->with('error','You Are Not Authorize To Create New Repair');
        }
        $request->validate([
            'name' => 'required|exists:customers,id',
            'phone_number' => 'required|string|max:15',
            'device_model' => 'required|exists:phone_models,id',
            'issue' => 'required|string|max:255',
            'priority' => 'required|exists:priorities,id',
            'status' => 'required|exists:statuses,id',
        ]);

        $save = Repair::query()->create([
            'customer_id' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'device_model_id' => $request->input('device_model'),
            'priority_id' => $request->input('priority'),
            'status_id' => $request->input('status'),
            'issue_description' => $request->input('issue'),
            'user_id' => Auth::id(),
        ]);
        if ($save) {
            return redirect()->back()->with('success', 'Repair created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create repair ticket.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        // Gate::authorize('show', Repair::class);

        $repair = Repair::with(['customer', 'model', 'priority', 'status'])->findOrFail($id);
        return view('Repairs.show', compact('repair'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(int $id)
    {
        // Gate::authorize('edit', Repair::class);

        $repair = Repair::with(['customer', 'model', 'priority', 'status'])->findOrFail($id);
        return view('Repairs.edit', compact('repair'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'issue_description' => 'required|string|max:255',
            'estimated_cost' => 'required|numeric',
            'final_cost' => 'required|numeric',
            'repair_date' => 'required|date',
            'completion_date' => 'required|date',
            'notes' => 'string',
            'pickup_date' => 'nullable|date',
        ]);

        $repair = Repair::findOrFail($id);
        $repair->update($validatedData);

        return redirect()->route('repairs.index')->with('success', 'Repair updated successfully.');

    }

    public function searchByTicket(Request $request)
    {
        $search = Repair::where('ticket_number', $request->search)->select('ticket_number', 'phone_number')->first();
        if ($search) {
            return response()->json($search);
        }
    }


    public function searchByDate(Request $request)
    {
        $getDate = Repair::select('repair_date')
            ->where('repair_date', $request->date)
            ->get();
        // dd($getDate->toArray());
        return response()->json($getDate, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {

        // Gate::authorize('delete', Repair::class);

        $repair = Repair::findOrFail($id);
        $repair->delete();

        return redirect()->route('repairs.index')->with('success', 'Repair deleted successfully.');
    }

    public function restore($id)
    {
        $repair = Repair::withTrashed()->findOrFail($id);
        if ($repair->trashed()) {
            $repair->restore();
            return redirect()->route('repairs.index')->with('success', 'Repair restored successfully.');
        }
        return redirect()->route('repairs.index')->with('info', 'Repair is not deleted.');
    }
}
