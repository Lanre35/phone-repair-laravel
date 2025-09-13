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
        $activeStatuses = Status::whereIn('name', ['pending', 'In progress', 'new'])->pluck('id');
        $completedStatus = Status::where('name', ['completed'])->pluck('id');
        $pendingPickupStatus = Status::where('name', ['ready_pickup'])->pluck('id')->first();

        // dd($activeStatuses, $completedStatus, $pendingPickupStatus);

        $stats = [
            'active_repairs' => Repair::whereIn('status_id', $activeStatuses)->count(),
            'completed_today' => Repair::where('status_id', 'completed')
                ->whereDate('completion_date', today())
                ->count(),
            'pending_pickup' => Repair::where('status_id', 'ready_pickup')->count(),
            'total_customers' => Customer::count(),
            'low_stock_items' => Inventory::whereRaw('stock_quantity <= min_stock')->count(),
            'daily_revenue' => Repair::where('status_id', 'completed')
                ->whereDate('completion_date', today())
                ->sum('final_cost') ?? 0
        ];
        // dd($stats['pending_pickup']);

        $recent_repairs = Repair::with('customer')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact('stats', 'recent_repairs'));
        // return response()->view('dashboard', compact('stats', 'recent_repairs'));

    }
}
