<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Services\OrderService;
use App\Services\OrderStatusService;
use App\Services\OrderLogService;
use App\Services\ShippingService;

class ContactOrderController extends Controller
{
    protected $customerService;
    protected $orderService;
    protected $orderStatusService;
    protected $orderLogService;
    protected $shippingService;

    public function __construct(
        CustomerService $customerService,
        OrderService $orderService,
        OrderStatusService $orderStatusService,
        OrderLogService $orderLogService,
        ShippingService $shippingService)
    {
        $this->customerService = $customerService;
        $this->orderService = $orderService;
        $this->orderStatusService = $orderStatusService;
        $this->orderLogService = $orderLogService;
        $this->shippingService = $shippingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contactId)
    {
        $customer = $this->customerService->getCustomerById($contactId);

        $orders = $this->orderService->getAllOrdersByContactId($contactId);

        return view('admin.contact-orders.index', compact('orders','customer'));
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($contactId, $id)
    {
        $order = $this->orderService->getOrderById($id);
        $order->type_shipping = $this->shippingService->getServiceDescription($order->type_shipping);

        return view('admin.contact-orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($contactId, $id)
    {
        $order = $this->orderService->getOrderById($id);
        $orderStatuses = $this->orderStatusService->getAllOrderStatusesToSelect();

        return view('admin.contact-orders.edit', compact('order','orderStatuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contactId, $id)
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
    public function destroy( $contactId, $id)
    {
        $order = $this->orderService->destroyOrder($id);

        return redirect()->route('admin.customers.orders.index', $contactId);
    }
}
