<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repair;
use App\Models\Customer;
use App\Models\Inventory;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stats = [
            'active_repairs' => Repair::whereIn('status', ['pending', 'in_progress'])->count(),
            'completed_today' => Repair::where('status', 'completed')
                ->whereDate('completion_date', today())
                ->count(),
            'pending_pickup' => Repair::where('status', 'ready_pickup')->count(),
            'total_customers' => Customer::count(),
            'low_stock_items' => Inventory::whereRaw('stock_quantity <= min_stock')->count(),
            'daily_revenue' => Repair::where('status', 'completed')
                ->whereDate('completion_date', today())
                ->sum('final_cost') ?? 0
        ];

        $recent_repairs = Repair::with('customer')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact('stats', 'recent_repairs'));
        // return response()->view('dashboard', compact('stats', 'recent_repairs'));

    }
}
