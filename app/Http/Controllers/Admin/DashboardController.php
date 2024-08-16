<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = 130;
        $totalUsers = 150;
        $totalSales = 1350.56;
        $totalCustomers = 50;
        $totalVisitors = 1547; 
        $totalBounceRate = 50;
        
        return view('admin.dashboard', compact('totalOrders','totalUsers', 'totalSales', 'totalCustomers', 'totalVisitors','totalBounceRate'));
    }
}
