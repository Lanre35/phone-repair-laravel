<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\Status;
use App\Models\Customer;
use App\Models\Inventory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $activeStatuses = Status::whereIn('name', ['pending', 'In progress', 'new'])
            ->pluck('id');
        $completedStatus = Status::where('name', 'completed')
            ->pluck('id')
            ->first();
        $pendingPickupStatus = Status::whereIn('name', ['Pending pickup'])
            ->pluck('id')
            ->first();
        $picked = Status::where('name', 'picked up')
            ->pluck('id')
            ->first();

        $stats = [
            'active_repairs' => Repair::whereIn('status_id', $activeStatuses)->count(),
            'completed_today' => Repair::where('status_id', $completedStatus)
                ->whereDate('completion_date', today())
                ->count(),
            'pending_pickup' => Repair::where('status_id', $pendingPickupStatus)->count(),
            'total_customers' => Customer::count(),
            'low_stock_items' => Inventory::whereRaw('stock_quantity <= min_stock')->count(),
            'daily_revenue' => Repair::where('status_id', $completedStatus)
                ->whereDate('completion_date', today())
                ->sum('final_cost') ?? 0,
            'pick_up' => Repair::where('status_id', $picked)
                ->whereDate('pickup_date', today())
                ->count(),
        ];
        // dd($stats);

        $recent_repairs = Repair::with('customer')
            ->latest()
            ->take(10)
            ->simplePaginate(2);
        $completed_repairs = Repair::with('customer')
            ->where('status_id', $completedStatus)
            ->latest()
            ->take(10)
            ->simplePaginate(2);

        $pending_pickup_repairs = Repair::with('customer')
            ->where('status_id', $pendingPickupStatus)
            ->latest()
            ->take(10)
            ->get();
        $picked_repairs = Repair::with('customer')
            ->where('status_id', $picked)
            ->latest()
            ->take(10)
            ->get();

        // dd($stats, $recent_repairs, $completed_repairs, $pending_pickup_repairs, $picked_repairs);
        return view('dashboard', compact('stats', 'recent_repairs', 'completed_repairs', 'pending_pickup_repairs', 'picked_repairs'));
        

    }
}
