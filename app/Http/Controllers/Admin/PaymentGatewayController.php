<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PaymentGatewayService;
use App\Http\Requests\AdminStoreUpdatePaymentGatewayRequest;

class PaymentGatewayController extends Controller
{
    protected $paymentGatewayService;

    public function __construct(PaymentGatewayService $paymentGatewayService)
    {
        $this->paymentGatewayService = $paymentGatewayService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentGateways = $this->paymentGatewayService->getAllPaymentGateways();

        return view('admin.payment-gateways.index', compact('paymentGateways'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentGateway = null;
        
        return view('admin.payment-gateways.create', compact('paymentGateway'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdatePaymentGatewayRequest $request)
    {
        $data = $request->all();
        
        $paymentGateway = $this->paymentGatewayService->makePaymentGateway($data);

        return redirect()->route('admin.payment-gateways.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentGateway = $this->paymentGatewayService->getPaymentGatewayById($id);
        
        return view('admin.payment-gateways.show', compact('paymentGateway'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentGateway = $this->paymentGatewayService->getPaymentGatewayById($id);
        
        return view('admin.payment-gateways.edit', compact('paymentGateway'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdatePaymentGatewayRequest $request, $id)
    {
        $data = $request->all();
 
        $paymentGateway = $this->paymentGatewayService->updatePaymentGateway($id, $data);

        return redirect()->route('admin.payment-gateways.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentGateway = $this->paymentGatewayService->destroyPaymentGateway($id);

        return redirect()->route('admin.payment-gateways.index');
    }
}
