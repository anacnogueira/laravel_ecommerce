<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateOrderRequest;
use App\Services\OrderService;
use App\Services\OrderStatusService;
use App\Services\OrderLogService;

class OrderController extends Controller
{
    protected $orderService;
    protected $orderStatusService;
    protected $orderLogService;

    public function __construct(
        OrderService $orderService,
        OrderStatusService $orderStatusService,
        OrderLogService $orderLogService
    )
    {
        $this->orderService = $orderService;
        $this->orderStatusService = $orderStatusService;
        $this->orderLogService = $orderLogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderService->getAllOrders();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->orderService->getOrderById($id);

        $orderStatuses = $this->orderStatusService->getAllOrderStatusesToSelect();

        return view('admin.orders.edit', compact('order', 'orderStatuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateOrderRequest $request, $id)
    {
        $data = $request->all();

        if ($data['type'] === 'order') {
            $this->orderService->updateTrackingCodeOrder($id, $data);
        }

        if ($data['type'] === 'log') {
            $this->orderLogService->makeOrderLog($id, $data);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = $this->orderService->destroyOrder($id);

        return redirect()->route('admin.orders.index');
    }


}
