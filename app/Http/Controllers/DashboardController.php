<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\AuditLog;

class DashboardController extends Controller
{
    /**
     * Display dashboard
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'total_products' => Product::count(),
            'recent_actions' => AuditLog::count(),
        ];

        $recentLogs = AuditLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'recentLogs'));
    }
}
