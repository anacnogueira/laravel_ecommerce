<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PaymentGatewayService;
use App\Services\OrderStatusService;
use App\Http\Requests\AdminStoreUpdateOrderStatusRequest;

class OrderStatusController extends Controller
{
    protected $orderStatusService;

    public function __construct(OrderStatusService $orderStatusService)
    {
        $this->orderStatusService = $orderStatusService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderStatuses = $this->orderStatusService->getAllOrderStatuses();

        return view('admin.order-status.index', compact('orderStatuses'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orderStatus = null;
        
        return view('admin.order-status.create', compact('orderStatus'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateOrderStatusRequest $request)
    {
        $data = $request->all();
        
        $orderStatus = $this->orderStatusService->makeOrderStatus($data);

        return redirect()->route('admin.order-status.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderStatus = $this->orderStatusService->getOrderStatusById($id);
        
        return view('admin.order-status.show', compact('orderStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderStatus = $this->orderStatusService->getOrderStatusById($id);
        
        return view('admin.order-status.edit', compact('orderStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateOrderStatusRequest $request, $id)
    {
        $data = $request->all();
 
        $orderStatus = $this->orderStatusService->updateOrderStatus($id, $data);

        return redirect()->route('admin.order-status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderStatus = $this->orderStatusService->destroyOrderStatus($id);

        return redirect()->route('admin.order-status.index');
    }
}
