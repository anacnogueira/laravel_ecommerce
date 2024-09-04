<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PaymentGatewayService;
use App\Services\PaymentMethodService;
use App\Http\Requests\AdminStoreUpdatePaymentMethodRequest;

class PaymentMethodController extends Controller
{
    protected $paymentMethodService;

    public function __construct(PaymentMethodService $paymentMethodService, PaymentGatewayService $paymentGatewayService)
    {
        $this->paymentMethodService = $paymentMethodService;
        $this->paymentGatewayService = $paymentGatewayService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethods = $this->paymentMethodService->getAllPaymentMethods();

        return view('admin.payment-methods.index', compact('paymentMethods'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentMethod = null;

        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione a integradora";

        $paymentGateways = $this->paymentGatewayService->getAllPaymentGateways();
        $paymentGateways = $paymentGateways->sortBy('name');
        $paymentGateways = $paymentGateways->prepend($select);
        
        return view('admin.payment-methods.create', compact('paymentMethod', 'paymentGateways'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdatePaymentMethodRequest $request)
    {
        $data = $request->all();
        
        $paymentMethod = $this->paymentMethodService->makePaymentMethod($data);

        return redirect()->route('admin.payment-methods.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentMethod = $this->paymentMethodService->getPaymentMethodById($id);
        
        return view('admin.payment-methods.show', compact('paymentMethod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentMethod = $this->paymentMethodService->getPaymentMethodById($id);
        
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdatePaymentMethodRequest $request, $id)
    {
        $data = $request->all();
 
        $paymentMethod = $this->paymentMethodService->updatePaymentMethod($id, $data);

        return redirect()->route('admin.payment-methods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentMethod = $this->paymentMethodService->destroyPaymentMethod($id);

        return redirect()->route('admin.payment-methods.index');
    }
}
