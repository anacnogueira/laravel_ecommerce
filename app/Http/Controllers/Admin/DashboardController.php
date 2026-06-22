<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\CustomerService;

class DashboardController extends Controller
{

    protected $orderService;
    protected $customerService;

    public function __construct(OrderService $orderService, CustomerService $customerService)
    {
        $this->orderService = $orderService;
        $this->customerService = $customerService;
    }

    public function index()
    {
        $totalOrders = $this->getTotalOrders();
        $totalUsers = $this->getTotalUsers();
        $totalSales = $this->getTotalSales();
        $totalCustomers = 50;
        $totalVisitors = 1547;
        $totalBounceRate = 50;

        return view('admin.dashboard', compact('totalOrders','totalUsers', 'totalSales', 'totalCustomers', 'totalVisitors','totalBounceRate'));
    }

    private function getTotalOrders()
    {
        return $this->orderService->getAllOrders()->count();
    }

    private function getTotalSales()
    {
        return $this->orderService->getTotalSalesAmount();
    }

    private function getTotalUsers()
    {
        return $this->customerService->getAllCustomers()->count();
    }
}
